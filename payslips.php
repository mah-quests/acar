<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';
require_once 'func/payslipCalculations.php';

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

// If filter types are not selected we show latest created data first
if (!$filter_col) {
    $filter_col = "generated_at";
}
if (!$order_by) {
    $order_by = "Asc";
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'id_number','gross', 'commission', 'overtime', 'bonus', 'other', 'paye_amount', 'uif_amount', 'nett_pay', 'payslip_date','generated_at','approved_leave','rate_per_day');

//Start building query according to input parameters.
// If search string
if ($search_string) 
{
    $db->where('first_names', '%' . $search_string . '%', 'like');
    $db->orwhere('last_name', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by)
{
    $db->orderBy($filter_col, $order_by);
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$firstDay=dayOneOfApp();
$lastDay=lastDayOfTheMonth();
$payslips = $db->join("payslips pay", "pay.id_number=can.id_number", "LEFT");
$payslips = $db->where('payslip_date', Array ($firstDay, $lastDay), 'BETWEEN');
$payslips = $db->get("candidates can",null);
$total_pages = $db->totalPages;

// get columns for order filter
foreach ($payslips as $value) {
    foreach ($value as $col_name => $col_value) {
        $filter_options[$col_name] = $col_name;
    }
    //execute only once
    break;
}
include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-6">
            <h1 class="page-header">All Payslips</h1>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search (name)</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>">
            <label for ="input_order">Order By</label>
            <select name="filter_col" class="form-control">

                <?php
                foreach ($filter_options as $option) {
                    ($filter_col === $option) ? $selected = "selected" : $selected = "";
                    echo ' <option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                }
                ?>

            </select>

            <select name="order_by" class="form-control" id="input_order">

                <option value="Asc" <?php
                if ($order_by == 'Asc') {
                    echo "selected";
                }
                ?> >Asc</option>
                <option value="Desc" <?php
                if ($order_by == 'Desc') {
                    echo "selected";
                }
                ?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">

        </form>
    </div>
<!--   Filter section end-->

    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th>Name</th>
                <th>ID Number</th>
                <th>Hosting Company</th>
                <th>Pay Date</th>
                <th>Gross</th>
                <th>Nett</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payslips as $row) : ?>
                <?php
                    $allIncome = addPayslipIncome($row['gross'], $row['commission'], $row['overtime'], $row['bonus'], $row['other']);
                    $nett_pay = $row['nett_pay'];
                ?>
                <tr>
	                <td><?php echo $row['id'] ?></td>
	                <td><?php echo htmlspecialchars($row['first_names']." ".$row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_number']) ?> </td>
                    <td><?php echo htmlspecialchars($row['hosting_company']) ?> </td>
                    <td><?php echo htmlspecialchars($row['payslip_date']) ?> </td>
                    <td><?php echo convertFormatting($allIncome) ?> </td>
                    <td><?php echo convertFormatting($nett_pay) ?> </td>
	                <td align="center">
                    <a href="view_payslip.php?payslip_id=<?php echo $row['id'] ?>&operation=edit" class="btn btn-primary" style="margin-right: 4px;"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
				</tr>

						<!-- Delete Confirmation Modal-->
					 <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
					    <div class="modal-dialog">
					      <form action="delete_candidate.php" method="POST">
					      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Confirm</h4>
						        </div>
						        <div class="modal-body">
						      
						        		<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['id'] ?>">
						        	
						          <p>Are you sure you want to delete this Candidate?</p>
						        </div>
						        <div class="modal-footer">
						        	<button type="submit" class="btn btn-default pull-left">Yes</button>
						         	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						        </div>
						      </div>
					      </form>
					      
					    </div>
  					</div>
            <?php endforeach; ?>      
        </tbody>
    </table>


   
<!--    Pagination links-->
    <div class="text-center">

        <?php
        if (!empty($_GET)) {
            //we must unset $_GET[page] if previously built by http_build_query function
            unset($_GET['page']);
            //to keep the query sting parameters intact while navigating to next/prev page,
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        //Show pagination links
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="payslips.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!--    Pagination links end-->

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

