<?php 
require_once './config/config.php';
require_once './func/payslipCalculations.php';
require_once './func/chartFunctions.php';


//Get the ID Number from the candidate table
function checkIDNumber($id_number){
    $db = getDbInstance();
    $db->where ('id_number', $id_number);
    $row = $db->getValue ('candidates', 'count(*)');
    
    return $row;
}

//Get the ID Number from the candidate table
function checkUserName($user_name){
    $db = getDbInstance();

    $db->where ('user_name', $user_name);
    $row = $db->getValue ('candidates', 'count(*)');

    return $row;
}

//Get the ID Number of the candidate selected
/*function getidNum(){

    $db = getDbInstance();
    $db->where ('id_number', $id_number);
    $newID = $db->getIDNumber()
}*/

function getIDNumber($candidate_id){
    $db = getDbInstance();

    $db->where ('id', $candidate_id);
    $row = $db->getOne ("candidates");
    $id_number = $row['id_number'];

    return $id_number;
}

//Get the ID Number of the candidate selected
function getPaySlipIDNumber($payslip_id){
    $db = getDbInstance();

    $db->where ('id', $payslip_id);
    $row = $db->getOne ("payslips");
    $id_number = $row['id_number'];

    return $id_number;
}

//Get User User Name row id number using candidate table
function getUserName($candidate_id){
    $db = getDbInstance();

    $db->where ('id', $candidate_id);
    $row = $db->getOne ("candidates");
    $user_name = $row['user_name'];

    return $user_name;
}



//Get row id number using candidate table
function getDBRowIDForPayslip($payslip_id, $db_name){
    $db = getDbInstance();

    $id_number = getPaySlipIDNumber($payslip_id);
    $db->where('id_number', $id_number);
    $row = $db->getOne($db_name);
    $rowId = $row['id'];

    return $rowId;
}

//Get row id number using candidate table
function getDBRowID($candidate_id, $db_name){
    $db = getDbInstance();

    $id_number = getIDNumber($candidate_id);
    $db->where('id_number', $id_number);
    $row = $db->getOne($db_name);
    $rowId = $row['id'];

    return $rowId;
}

function getRowOnEditPayslip($payslip_id, $db_name){
    $db = getDbInstance();
    
    $rowId = getDBRowIDForPayslip($payslip_id, $db_name);
    $db->where('id', $rowId);
    $output = $db->getOne($db_name);

    return $output;
}

function getRowOnEdit($candidate_id, $db_name){
    $db = getDbInstance();
    
    $rowId = getDBRowID($candidate_id, $db_name);
    $db->where('id', $rowId);
    $output = $db->getOne($db_name);

    return $output;
}

function getCompanyDetailsRowOnEdit($candidate_id, $db_name){
    $db = getDbInstance();
    
    $db->where('id', $candidate_id);
    $output = $db->getOne($db_name);

    return $output;
}

// Get the first day of the month
function firstDayOfTheMonth(){
    $db = getDbInstance();
    $firstDay = $db->rawQuery('select last_day(curdate() - interval 1 month) + interval 1 day');

    foreach ($firstDay as $row) {
        $firstDay=$row['last_day(curdate() - interval 1 month) + interval 1 day'];
        return $firstDay;
    }

}

// Get the first day of the month
function currentDay(){
    
    $currentDate = date("Y-m-d");
    return $currentDate;

}

// Get the first day of the month
function dayOneOfApp(){
    
    $firstDay = '1970-01-01';
    return $firstDay;  //fix here dave

}

// Get the first day of the month
function dayOneOfInternship($id_number){
    $con = getConnection();
    populateGraphsData();

    $internship_date = '2018-01-01';

    $query = "SELECT employment_date from internship_details where id_number='$id_number' ";
    $exec = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($exec)){
        $internship_date = $row['employment_date'];
    }

     return $internship_date;

}

// Get the last day of the month
function lastDayOfTheMonth(){
    $db = getDbInstance();
    $lastDay = $db->rawQuery('select last_day(curdate())');

    foreach ($lastDay as $row) {
        $lastDay=$row['last_day(curdate())'];
        return $lastDay;
    }

}

// Check the number of days the candidate has worked this particular month
function numberOfDaysCandidateWorked($id_number, $db_name){
    $db = getDbInstance();

    $lastDay = lastDayOfTheMonth();
    $firstDay = firstDayOfTheMonth();
    $count = 0;

    if ($db_name == 'time_in'){
        $numberOfDays = $db->where('check_in_date', Array ($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $count = $db->getValue ($db_name, 'count(*)');
    } else {
        $numberOfDays = $db->where('check_out_date', Array ($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $count = $db->getValue ($db_name, 'count(*)');       
    }

    return $count;

}
//check absent days

// Check the number of days the candidate has worked this particular month
function numberOfDaysCandidateWasPresent($id_number){
    $db = getDbInstance();

    $firstDay = dayOneOfInternship($id_number);
    $lastDay = currentDay();
    
    $count = 0;

    $numberOfDays = $db->where('check_in_date', Array ($firstDay, $lastDay), 'BETWEEN');
    $numberOfDays = $db->where('id_number', $id_number);
    $count = $db->getValue ('time_in', 'count(*)');

    if ($count == 0 ){
        $count = 0;
    } 

    return $count;

}

function expectedTotalDaysPerCandidate($id_number){

    $firstDay = dayOneOfInternship($id_number);
    $lastDay = currentDay();

    $count = 0;

    $start = strtotime($firstDay);
    $end = strtotime($lastDay);

    

    while($start < $end)
    {
        
        $month = date('Y-m-d', $start);
        $start = strtotime("+1 month", $start);
        $givenMonth = getNumberOfWorkingDays($month) . " " ;

        $count ++; //$count + $givenMonth;

    }

    return $count;

}
//================ ME=================//
// ave to add an absent feature       //
//                                    //
//====================================//

function numberOfDaysCandidateWasAbsent($id_number){
    $expectedDays = expectedTotalDaysPerCandidate($id_number);
    $actualDaysPresent = numberOfDaysCandidateWasPresent($id_number);

    $numberOfDaysAbsent = $expectedDays - $actualDaysPresent;

    return $numberOfDaysAbsent;
}

//Check the actual dates and times of days the candidate has worked this particular month
function getAllCheckValues($id_number, $db_name){
    $db = getDbInstance();

    $lastDay = lastDayOfTheMonth();
    $firstDay = firstDayOfTheMonth();
    $count = 0;

    if ($db_name == 'time_in'){
        $numberOfDays = $db->where('check_in_date', Array ($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $results = $db->get ('time_in');
    } else {
        $numberOfDays = $db->where('check_out_date', Array ($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $results = $db->get ('time_out');       
    }

    foreach ($results as $row){
        $dayTime=$row['created_at'];
        print_r($dayTime); 
        echo "<br>";
    }

}

// delete all entries in 
function deleteAll($id_number){

    $db = getDbInstance();
    $db->where('id_number', $id_number);
    $candidate_details = $db->getOne('candidates');
    $candidate_id = $candidate_details['id'];

    //Deleting an entry if available in the admin_accounts table
    $rowID = getDBRowID($candidate_id, 'admin_accounts');    
    if ($rowID == 0){
      //  echo "$id_number does not have an entry in the admin_accounts table";
    } else {
        $db->where('id', $rowID);
        $db->delete('admin_accounts');
    }

    //Deleting an entry if available in the bank_account table
    $rowID = getDBRowID($candidate_id, 'bank_account');
    if ($rowID == 0){
        echo "$id_number does not have an entry in the bank_account table";
    } else {
        $db->where('id', $rowID);
        $db->delete('bank_account');
    }

    //Deleting an entry if available in the internship_details table
    $rowID = getDBRowID($candidate_id, 'internship_details');
    if ($rowID == 0){
        echo "$id_number does not have an entry in the internship_details table";
    } else {
        $db->where('id', $rowID);
        $db->delete('internship_details');
    }

    //Deleting all entries for a given id_number in the payslips table
    $db->where('id_number', $id_number);
    $payslips_rows = $db->get('payslips');

    foreach ($payslips_rows as $payslips_row) {
        $payslip_id = $payslips_row['id'];
        $db->where('id', $payslip_id);
        $rest = $db->delete('payslips');
    }

    //Deleting all entries for a given id_number in the time-in table
    $db->where('id_number', $id_number);
    $time_in_rows = $db->get('time_in');

    foreach ($time_in_rows as $time_in_row) {
        $time_in_id = $time_in_row['id'];
        $db->where('id', $time_in_id);
        $rest = $db->delete('time_in');
    }

    //Deleting all entries for a given id_number in the time-out table
    $db->where('id_number', $id_number);
    $time_out_rows = $db->get('time_out');

    foreach ($time_out_rows as $time_out_row) {
        $time_out_id = $time_out_row['id'];
        $db->where('id', $time_out_id);
        $rest = $db->delete('time_out');
    }

    //Finishing off to delete the candidates table
    if ($candidate_id == 0){
        echo "$id_number does not have an entry in the candidates table";
    } else {
        $db->where('id', $candidate_id);
        $status = $db->delete('candidates');
    }

    return $status;

}

// Provide the method with the id number, and the database name (time_in or time_out)
function checkIfCheckedIn($id_number,$db_name){

    $today=date('Y-m-d');
    $today=preg_replace('/\s+/', '', $today);
    $id_number=preg_replace('/\s+/', '', $id_number);

    $db = getDbInstance();

    if ($db_name == 'time_in'){
        $db->where ('id_number', $id_number);
        $db->where ('check_in_date', $today);
        $results = $db->get ($db_name);
    } else {
        $db->where ('id_number', $id_number);
        $db->where ('check_out_date', $today);
        $results = $db->get ($db_name);        
    }

    return $db->count;

}

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function candidateData(&$data_to_update){

    //Candidates Array
    //Extract information relevent to admin_accounts table
    $first_names=$data_to_update['first_names'];
    $last_name=$data_to_update['last_name'];
    $gender=$data_to_update['gender'];
    $hosting_company=$data_to_update['hosting_company'];
    $supervisor_name=$data_to_update['supervisor_name'];
    $supervisor_email=$data_to_update['supervisor_email'];
    $phone=$data_to_update['phone'];
    $email=$data_to_update['email'];
    $date_of_birth=$data_to_update['date_of_birth'];
    $candidate_address=$data_to_update['candidate_address'];
    $id_number=$data_to_update['id_number'];
    $created_at=$data_to_update['created_at'];
    $updated_at=$data_to_update['updated_at'];
    $supervisor_phone=$data_to_update['supervisor_phone'];
    $hosting_address=$data_to_update['hosting_address'];
    $user_name=$data_to_update['user_name'];

    $candidate_update = Array ( 'first_names' => $first_names,
                                'last_name' => $last_name,
                                'gender' => $gender,
                                'hosting_company' => $hosting_company,
                                'supervisor_name' => $supervisor_name,
                                'supervisor_email' => $supervisor_email,
                                'phone' => $phone,
                                'email' => $email,
                                'date_of_birth' => $date_of_birth,
                                'candidate_address' => $candidate_address,
                                'id_number' => $id_number,
                                'created_at' => $created_at,
                                'updated_at' => $updated_at,
                                'supervisor_phone' => $supervisor_phone,
                                'hosting_address' => $hosting_address,
                                'user_name' => $user_name
    ); 

    return $candidate_update;

}

function bankDetailData(&$data_to_update){

    //Extract information relevent to bank_accounts table
    $id_number=$data_to_update['id_number'];
    $account_owner=$data_to_update['account_owner'];
    $bank_name=$data_to_update['bank_name'];
    $branch_name=$data_to_update['branch_name'];
    $branch_code=$data_to_update['branch_code'];
    $account_number=$data_to_update['account_number'];

    $bank_account_update = Array (  'id_number' => $id_number,
                                    'account_owner' => $account_owner,
                                    'account_number' => $account_number,
                                    'bank_name' => $bank_name,
                                    'branch_name' => $branch_name,
                                    'branch_code' => $branch_code
    );  

    return $bank_account_update;
}

function loginDetailData(&$data_to_update){

    //Extract information relevent to admin_accounts table
    $user_name=$data_to_update['user_name'];
    $passwd=$data_to_update['passwd'];
    $admin_type=$data_to_update['admin_type'];
    $id_number=$data_to_update['id_number'];

    $login_account_update = Array ( 'user_name' => $user_name,
                                    'passwd' => $passwd,
                                    'admin_type' => $admin_type,
                                    'id_number' => $id_number
    );

    return $login_account_update;

}

function internshipDetailData(&$data_to_update){

    $id_number=$data_to_update['id_number'];
    $employment_date=$data_to_update['employment_date'];
    $position=$data_to_update['position'];
    $department=$data_to_update['department'];
    $tax_ref=$data_to_update['tax_ref'];
    $salary_amount=$data_to_update['salary_amount'];

    $internship_detail_update = Array ( 'id_number' => $id_number,
                                        'employment_date' => $employment_date,
                                        'position' => $position,
                                        'department' => $department,
                                        'tax_ref' => $tax_ref,
                                        'salary_amount' => $salary_amount,
    ); 

    return $internship_detail_update;
    
    }


function companyDetailData(&$data_to_update){

    $business_name=$data_to_update['business_name'];
    $ck_number=$data_to_update['ck_number'];
    $address1=$data_to_update['address1'];
    $address2=$data_to_update['address2'];
    $city=$data_to_update['city'];
    $postal_code=$data_to_update['postal_code'];
    $phone_number=$data_to_update['phone_number'];
    $email=$data_to_update['email'];
    $web=$data_to_update['web'];
    $sdl_number=$data_to_update['sdl_number'];
    $paye_number=$data_to_update['paye_number'];
    $uif_number=$data_to_update['uif_number'];
    $updated_at=$data_to_update['updated_at'];


    $company_detail_update = Array ( 'business_name' => $business_name,
                                        'ck_number' => $ck_number,
                                        'address1' => $address1,
                                        'address2' => $address2,
                                        'city' => $city,
                                        'postal_code' => $postal_code,
                                        'phone_number' => $phone_number,
                                        'email' => $email,
                                        'web' => $web,
                                        'sdl_number' => $sdl_number,
                                        'paye_number' => $paye_number,
                                        'uif_number' => $uif_number,
                                        'updated_at' => $updated_at,                                        
    ); 

    return $company_detail_update;
    
    }

function updateCandidateData($candidate_id, &$data_to_update){

    $candidate_update = candidateData($data_to_update);

    $db = getDbInstance();

    $db->where('id',$candidate_id);
    $last_id = $db->update('candidates', $candidate_update); 

    return $last_id;
}

function addCandidateData(&$data_to_store){

    $new_candidate = candidateData($data_to_store);

    $db = getDbInstance();
    $last_id = $db->insert ('candidates', $new_candidate);

    return $last_id;
}

function updateAdminAccounts($candidate_id, &$data_to_update){

    $login_account_update = loginDetailData($data_to_update);

    $db = getDbInstance();
    $rowId = getDBRowID($candidate_id, 'admin_accounts');

    $db->where('id',$rowId);
    $last_id = $db->update('admin_accounts', $login_account_update); 

    return $last_id;
}

function addAdminAccounts(&$data_to_store){

    $new_login_account = loginDetailData($data_to_store);

    $db = getDbInstance();
    $last_id = $db->insert ('admin_accounts', $new_login_account);

    return $last_id;
}


function updateInternshipDetails($candidate_id, &$data_to_update){

    $internship_detail_update = internshipDetailData($data_to_update);

    $db = getDbInstance();
    $rowId = getDBRowID($candidate_id, 'internship_details');

    $db->where('id',$rowId);
    $last_id = $db->update('internship_details', $internship_detail_update); 

    return $last_id;
}

function addInternshipDetails(&$data_to_store){

    $new_internship_details = internshipDetailData($data_to_store);

    $db = getDbInstance();
    $last_id = $db->insert ('internship_details', $new_internship_details);

    return $last_id;
}

function updateBankDetails($candidate_id, &$data_to_update){

    $bank_account_update = bankDetailData($data_to_update);

    $db = getDbInstance();
    $rowId = getDBRowID($candidate_id, 'bank_account');

    $db->where('id',$rowId);
    $last_id = $db->update('bank_account', $bank_account_update); 

    return $last_id;
}

function addBankDetails(&$data_to_store){

    $bank_account_update = bankDetailData($data_to_store);

    $db = getDbInstance();
    $last_id = $db->insert ('bank_account', $bank_account_update);

    return $last_id;
}

function updateCompanyDetails($company_id, &$data_to_update){

    $company_id = 1;
    $company_details_update = companyDetailData($data_to_update);

    $db = getDbInstance();

    $db->where('id',$company_id);
    $last_id = $db->update('business_infomation', $company_details_update); 

    return $last_id;
}

function addCompanyDetails(&$data_to_store){

    $company_details_update = companyDetailData($data_to_store);

    $db = getDbInstance();
    $last_id = $db->insert ('business_infomation', $company_details_update);

    return $last_id;
}

?>