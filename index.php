<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

//Get Dashboard information
$numCustomers = $db->getValue('candidates', 'count(*)');

//Check In/Check Out Today
$today = date('Y-m-d');
$numCheckIns = $db->where('check_in_date', $today);
$numCheckIns = $db->getValue('time_in', 'count(*)');
$numCheckOuts = $db->where('check_out_date', $today);
$numCheckOuts = $db->getValue('time_out', 'count(*)');

//Check In/Check Out Yesterday
$yesterday = date('Y-m-d', strtotime('yesterday'));
$numCheckInsYd = $db->where('check_in_date', $yesterday);
$numCheckInsYd = $db->getValue('time_in', 'count(*)');
$numCheckOutsYd = $db->where('check_out_date', $yesterday);
$numCheckOutsYd = $db->getValue('time_out', 'count(*)');

$numHostingCompanies = $db->getValue('candidates', 'count(DISTINCT(hosting_company))');

//Candidates not checked in today
// $candidatesNotCheckedIn = $numCustomers - $numCheckIns;

$candidatesNotCheckedIn = $db->rawQuery("SELECT count(*) FROM candidates WHERE id_number not in (SELECT id_number from time_in where check_in_date='$today')");

foreach ($candidatesNotCheckedIn as $row) {
    $candidatesNotCheckedIn = $row['count(*)'];
}

//Populating Candidate Dashboard information
$username = $_SESSION['username'];
$id_number = $db->where('user_name', $username);
$id_number = $db->getValue('candidates', 'id_number');
$no_of_check_ins = numberOfDaysCandidateWorked($id_number, 'time_in');
$no_of_check_outs = numberOfDaysCandidateWorked($id_number, 'time_out');

//Populating Candidate Link to data
$username = $_SESSION['username'];
$id = $db->where('user_name', $username);
$id = $db->getValue('candidates', 'id');

include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <?php  if ($_SESSION['admin_type'] == 'super') {
    ?>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCustomers; ?></div>
                            <div>Partner Representatives</div>
                        </div>
                    </div>
                </div>
                <a href="candidates.php"> 
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numHostingCompanies; ?></div>
                            <div>Civil Society <br> Partners</div>
                        </div>
                    </div>
                </div>
              <!--  <a href="view_hosted_company.php"> -->
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check-circle-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCheckIns; ?></div>
                            <div>Check-In<br> Today</div>
                        </div>
                    </div>
                </div>
                <a href="candidate_in_today.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>  
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-circle-o-notch fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCheckOuts; ?></div>
                            <div>Check-Out<br> Today</div>
                        </div>
                    </div>
                </div>
                <a href="candidate_out_today.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-gray">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-hand-paper-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $candidatesNotCheckedIn; ?></div>
                            <div>Partner Representatives Not Checked In Today</div>
                        </div>
                    </div>
                </div>
                <a href="add_not_check_in.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>                
        <div class="col-lg-3 col-md-6">
        
        </div>
        <div class="col-lg-3 col-md-6">
            
        </div>
<!-- Testing formatting -->

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Historical Analytics</h3>
        </div>
            <div class="col-lg-6 col-md-12">
             <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCheckInsYd; ?></div>
                            <div>Check-In <br> Yesterday</div>
                        </div>
                    </div>
                </div>
                <a href="candidate_in_yesterday.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>  
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-clode fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCheckInsYd; ?></div>
                            <div>Check-Out <br>Yesterday</div>
                        </div>
                    </div>
                </div>
                <a href="candidate_out_yesterday.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
    </div>
        <?php
} else {
        ?>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $no_of_check_ins; ?></div>
                            <div>No. of Check-In in the current month</div>
                        </div>
                    </div>
                </div>
                <!--   <a href="candidates.php">   -->
                <?php if ($id == 0) {
            ?>
                <a href="#">
                <?php
        } else {
            ?>
                <a href="candidate_checked_month.php?candidate_id=<?php echo $id; ?>&operation=edit">                    
                <?php
        } ?>
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell-slash-o fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $no_of_check_outs; ?></div>
                            <div>No. of Check-Out in the current month</div>
                        </div>
                    </div>
                </div>
                <?php if ($id == 0) {
            ?>
                <a href="#">
                <?php
        } else {
            ?>
                <a href="candidate_checked_month.php?candidate_id=<?php echo $id; ?>&operation=edit">                    
                <?php
        } ?>
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>            
    <?php
    }?>
    </div>


    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once 'includes/footer.php'; ?>
