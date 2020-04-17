<?php 
require_once 'func/functions.php';
require_once 'func/payslipCalculations.php';

function countNumberOfCandidates($month){
	$expected = expectedChecks($month);
	$checkIns = numberOfCheckInsGivenMonth($month);
	$checkOuts = numberOfCheckOutsGivenMonth($month);

	$graphValues = $expected.','.$checkIns.','.$checkOuts;

	return $graphValues;

}

function nameOfTheMonth($month){
	$dayOneOfMonth = startDayOfMonth($month);
	$myDateTime = DateTime::createFromFormat('Y-m-d', $dayOneOfMonth);
	$nameOfMonth = date_format($myDateTime,'M-y');

	return $nameOfMonth;
}

function graphDates($month){
    $dayOneOfMonth = startDayOfMonth($month);
    $myDateTime = DateTime::createFromFormat('Y-m-d', $dayOneOfMonth);
    $graphDateFormat = date_format($myDateTime,'Y-m-d');

    return $graphDateFormat;
}

function expectedChecks($month){
	    $db = getDbInstance();

	    $numOfCandidates = $db->getValue ('candidates', 'count(*)');
	    $dayOneOfMonth = graphDates($month);
	    $numberOfWorkingDays = 	getNumberOfWorkingDays($dayOneOfMonth);

	    $expectedChecksThisMonth = $numOfCandidates * $numberOfWorkingDays;

	    return $expectedChecksThisMonth;
}

function startDayOfMonth($month){
	//The year is static and will have to be made dynamic later please
	$dayOne = '2019-'.$month.'-01';

	return $dayOne;
}

function lastDayOfMonth($month){
	//The year is static and will have to be made dynamic later please
	$givenDate = $dateGiven = '2019-'.$month.'-01';
	$lastDay = lastDayOfGivenMonth($givenDate);

	return $lastDay;
}

function numberOfCheckInsGivenMonth($month){
    $db = getDbInstance();

    $firstDay=startDayOfMonth($month);
    $lastDay=lastDayOfMonth($month);
    $count = 0;

    $numberOfDays = $db->where('check_in_date', Array ($firstDay, $lastDay), 'BETWEEN');
    $count = $db->getValue ('time_in', 'count(*)');

    return $count;

}

function numberOfCheckOutsGivenMonth($month){
    $db = getDbInstance();

    $firstDay=startDayOfMonth($month);
    $lastDay=lastDayOfMonth($month);
    $count = 0;

    $numberOfDays = $db->where('check_out_date', Array ($firstDay, $lastDay), 'BETWEEN');
    $count = $db->getValue ('time_out', 'count(*)');

    return $count;

}

function populateGraphsData(){

	$db = getDbInstance();

	$tablePopulated = $db->getValue ('graph_details', 'count(*)');

	if ($tablePopulated > 0){
		truncateTable();
	}


	for ($count = 06; $count < 18; $count++){
		$month = sprintf("%02d", $count);
		$month_name = nameOfTheMonth($month);
		$expected_checks = expectedChecks($month);
        $actual_check_ins = numberOfCheckInsGivenMonth($month);
        $actual_check_outs = numberOfCheckOutsGivenMonth($month);

		if ($actual_check_ins > 0){
			$success_percentage = ($actual_check_ins / $expected_checks) * 100;	
			$success_percentage = number_format( $success_percentage, 2);
		} else {
			$success_percentage = 0;
            $success_percentage = number_format( $success_percentage, 2);
		}
		
    	
	    $year_stats = Array ( 'month_name' => $month_name,
	                                        'expected_checks' => $expected_checks,
	                                        'actual_check_ins' => $actual_check_ins,
	                                        'actual_check_outs' => $actual_check_outs,
	                                        'success_percentage' => $success_percentage
	    ); 

	    $last_id = $db->insert ('graph_details', $year_stats);

	}

}

function truncateTable(){

	$db = getDbInstance();

	$results = $db->query('DELETE FROM graph_details');
	$results = $db->query('ALTER TABLE graph_details AUTO_INCREMENT = 1;');

	return $results;

}

function truncateAbsenteesTable(){

	$db = getDbInstance();

	$results = $db->query('DELETE FROM absenteeism_stats');
	$results = $db->query('ALTER TABLE absenteeism_stats AUTO_INCREMENT = 1;');

	return $results;

}

function absenteesList(){
	$db = getDbInstance();

	$tablePopulated = $db->getValue ('absenteeism_stats', 'count(*)');

	if ($tablePopulated > 0){
		truncateAbsenteesTable();
	}

	$candidates = $db->get("candidates");

	foreach ($candidates as $row){
		$full_names = $row['first_names']." ".$row['last_name'];
		$gender = $row['gender'];
		$id_number = $row['id_number'];
		$hosting_company = $row['hosting_company'];
		$days_absent = numberOfDaysCandidateWasAbsent($id_number);

	    $absentees_stats = Array ( 'full_names' => $full_names,
	                               'gender' => $gender,
	                               'id_number' => $id_number,
	                               'hosting_company' => $hosting_company,
	                               'days_absent' => $days_absent
	    ); 

	    $last_id = $db->insert ('absenteeism_stats', $absentees_stats);		

	}

	return $last_id;
}

function overallSuccessPercentage(){


	$con = getConnection();
	populateGraphsData();

	$query = "SELECT success_percentage from graph_details";

	 $exec = mysqli_query($con,$query);

	 $sum = 0;

	 while($row = mysqli_fetch_array($exec)){

	 	$percentage = $row['success_percentage'];
	 	$sum += $percentage;

	 }

	 $sum = $sum/12;
	 return number_format( $sum, 2);

}

?>