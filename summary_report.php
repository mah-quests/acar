<?php 
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
require_once './func/functions.php';
require_once './func/chartFunctions.php';

include_once './includes/header.php';

?>

<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Project Impact Analysis</h2>
    </div>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Expected CheckIn', 'Actual Check-Ins', 'Actual Check-Outs'],

 		<?php 

			$con = getConnection();
			populateGraphsData();

			$query = "SELECT * from graph_details";
 
			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){
 
			 echo "['".$row['month_name']."',".$row['expected_checks'].",".$row['actual_check_ins'].",".$row['actual_check_outs']."],";
			 }
		?> 

        ]);

        var options = {
          chart: {
            title: 'Summary of Partner Representatives Attandance',
            subtitle: 'Check Ins, Check Outs, and Project Sucess Percentages',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 100%; height: 400px;"></div>

    <div class="row">
        <h4 class="page-header">Overall Success Percentage of the Project : <?php echo overallSuccessPercentage();?> % </h4>
    </div>

	<?php 
	    $db = getDbInstance();
	    $months = $db->get ("graph_details");
	?>

    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th>Month</th>
                <th>Success Percentage</th>
                <td><?php echo $row['id'] ?></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($months as $row) : ?>
                <tr>
	                <td><?php echo $row['id'] ?></td>
	                <td><?php echo htmlspecialchars($row['month_name']) ?></td>
	                <td><?php echo htmlspecialchars($row['success_percentage']) ?> </td>
				</tr>
            <?php endforeach; ?>  
        </tbody>
    </table>

    <div class="row">
        <h4 class="page-header"><a href="absentees_report.php">Detailed Absenteeism List</a></h4>
    </div>

  </body>
</html>
</div>
<?php include_once 'includes/footer.php'; ?>