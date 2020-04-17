<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';

// Sanitize if you want
$candidate_id = filter_input(INPUT_GET, 'candidate_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
$db = getDbInstance();


//If edit variable is set, we are performing the update operation.
if($edit)
{

    //Get data to pre-populate the candidate part of the form.
    $db->where('id', $candidate_id);    
    $candidate = $db->getOne("candidates");

    $systemsLogin = getRowOnEdit($candidate_id, 'admin_accounts');
    $internship = getRowOnEdit($candidate_id, 'internship_details');
    $bankAccount = getRowOnEdit($candidate_id, 'bank_account');

}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">View Partner Representative Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
//            require_once('./forms/candidate_form_payroll.php'); 
        require_once('./forms/candidate_read.php'); 
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>