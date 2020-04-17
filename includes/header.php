<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Nerve Center Attendance Register</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- MetisMenu CSS -->
        <link href="js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script src="js/jquery.min.js" type="text/javascript"></script> 

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) : ?>
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <?php  if ($_SESSION['admin_type'] == 'super') {
    ?>
                            <a class="navbar-brand" href="">Administrator</a>
                        <?php
} else {
        ?>
                            <a class="navbar-brand" href="">Partner Representative</a>
                        <?php
    } ?>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <!-- /.dropdown -->

                        <!-- /.dropdown -->
                        <li>Logged in as <b><i><?php echo $_SESSION['username']; ?></i></b></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>                                
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="edit_company_details.php?company_id=1&operation=edit" "><i class="fa fa-user fa-fw"></i> Company Profile</a>
                                </li>
                                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li>
                                    <a href="index.php"><i class="fa fa-tv fa-fw"></i> Dashboard </a>
                                </li>
                                <?php  if ($_SESSION['admin_type'] == 'super') {
        ?>
                                <li <?php echo (CURRENT_PAGE == 'candidates.php' || CURRENT_PAGE == 'add_candidate.php') ? 'class="active"' : ''; ?>>
                                    <a href="#"><i class="fa fa-user-o fa-fw"></i> Partner Representative<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="candidates.php"><i class="fa fa-list fa-fw"></i> List all </a>
                                        </li>
                                    <li>
                                        <a href="add_candidate.php"><i class="fa fa-plus fa-fw"></i> Add New </a>
                                    </li>
                                    </ul>
                                </li> 
                                <?php
    } ?>
                                <li <?php echo (CURRENT_PAGE == 'candidates.php' || CURRENT_PAGE == 'add_candidate.php') ? 'class="active"' : ''; ?>>
                                    <a href="#"><i class="fa fa-angle-double-down fa-fw"></i> Check In/Out <span class="fa arrow"></span></a>
                                    <?php
                                        $db = getDbInstance();

                                        $username = $_SESSION['username'];
                                        $id = $db->where('user_name', $username);
                                        $id = $db->getValue('candidates', 'id');
                                    ?>

                                <?php  if ($_SESSION['admin_type'] == 'super') {
                                        ?>

                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="add_check_in.php"><i class="fa fa-plus-square-o fa-fw"></i> Check In </a>
                                        </li>
                                    <li>
                                        <a href="add_check_out.php"><i class="fa fa-minus-square-o fa-fw"></i> Check Out </a>
                                    </li>
                                    </ul>

                                <?php
                                    } else {
                                        ?>

                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="check_in_confirmed.php?candidate_id=<?php echo $id; ?>&operation=edit"><i class="fa fa-plus-square-o fa-fw"></i> Check In </a>
                                        </li>
                                    <li>
                                        <a href="check_out_confirmed.php?candidate_id=<?php echo $id; ?>&operation=edit"><i class="fa fa-minus-square-o fa-fw"></i> Check Out </a>
                                    </li>
                                    </ul>

                                <?php
                                    } ?>

                                </li>  
                                <?php  if ($_SESSION['admin_type'] == 'super') {
                                        ?>
                                <li <?php echo (CURRENT_PAGE == 'candidates.php' || CURRENT_PAGE == 'add_candidate.php') ? 'class="active"' : ''; ?>>
                                    <a href="#"><i class="fa fa-folder-open-o fa-fw"></i> Reports & Activities <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                <!-- <a href="summary_report.php"><i class="fa fa-line-chart fa-fw"></i> Summarized Reports </a>
                                        </li>
                                        <li>
                                            <a href="month_report.php"><i class="fa fa-tasks fa-fw"></i> Current Month Stats </a>
                                        </li>  -->
                                        <li>
                                        <a href="candidate_report.php"><i class="fa fa-flag-o fa-fw"></i> Partner Representative Stats </a>
                                        </li>
                                        <li>
                                            <a href="candidate_in.php"><i class="fa fa-thumbs-o-up fa-fw"></i> All User Check Ins </a>
                                        </li>
                                        <li>
                                            <a href="candidate_out.php"><i class="fa fa-thumbs-o-down fa-fw"></i> All User Check Outs </a>
                                        </li>                                        
                                    </ul>
                                </li> 
                              <!--  <li>
                                    <a href="#"><i class="fa fa-hourglass-end fa-fw"></i> Payslips <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="payslips.php"><i class="fa fa-stack-overflow fa-fw"></i> All Payslips </a>
                                        </li>
                                        <li>
                                            <a href="payslips_month.php"><i class="fa fa-calendar-check-o fa-fw"></i> This Month Payslips </a>
                                        </li>                                        
                                        <li>
                                            <a href="generate_payslip.php"><i class="fa fa-spinner fa-fw"></i> Generate Payslip </a>
                                        </li>
                                    </ul>
                                </li>-->
                                <li>
                                    <a href="admin_users.php"><i class="fa fa-user-plus"></i> Users </a>
                                </li> 
                                <?php
                                    } else {
                                        ?>
                                <li>
                                    <a href="#"><i class="fa fa-hourglass-end fa-fw"></i> Payslips <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="payslips.php"><i class="fa fa-plus-square-o fa-fw"></i> All Payslips </a>
                                        </li>
                                    <li>
                                        <a href="payslips_month.php"><i class="fa fa-minus-square-o fa-fw"></i> Current Payslips </a>
                                    </li>
                                    </ul>                                    
                                <?php
                                    }  ?>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>
            <?php endif; ?>
            <!-- The End of the Header -->