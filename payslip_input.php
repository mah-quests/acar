<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';
require_once 'func/payslipCalculations.php';

// Sanitize if you want
$candidate_id = filter_input(INPUT_GET, 'candidate_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'create') ? $create = true : $create = false;

$db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data_to_create_payslip = filter_input_array(INPUT_POST);    
    $data_to_create_payslip['generated_at'] = date('Y-m-d H:i:s');

    //Extract information relevent to bank_accounts table
    $id_number=$data_to_create_payslip['id_number'];
    $payslip_date=$data_to_create_payslip['payslip_date'];

    if(payslipAlreadyGenerated($id_number,$payslip_date) == 0){

    $last_id = addPayslipDetails($data_to_create_payslip);

    if($last_id) {
        $_SESSION['success'] = "Payslip added successfully!";
        header('location: payslips.php');
        exit();
        }
    }  else{
        $_SESSION['failure'] = "Payslip already generated this month!";
        header('location: payslips.php');
        exit();
    } 

}


//If edit variable is set, we are performing the update operation.
if($create)
{
    $db->where('id', $candidate_id);    
    $candidate = $db->getOne("candidates");

    $payslip = getRowOnEdit($candidate_id, 'payslips');
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Payslip Input</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/payslip_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>