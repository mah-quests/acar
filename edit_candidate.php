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

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $data_to_update['passwd']=md5($data_to_update['passwd']);
    
    //Updating Candidate Information
    if (getDBRowID($candidate_id, 'candidates') == 0){
        $last_id = addCandidateData($data_to_update);
    } else {
        $last_id = updateCandidateData($candidate_id, $data_to_update);
    }

    //Accessing the admin_accouts table
    if (getDBRowID($candidate_id, 'admin_accounts') == 0){
        $last_id = addAdminAccounts($data_to_update);
    } else {
        $last_id = updateAdminAccounts($candidate_id, $data_to_update);
    }
 
    //Accessing the internship_details table
    if (getDBRowID($candidate_id, 'internship_details') == 0){
        $last_id = addInternshipDetails($data_to_update);        
    } else {
        $last_id = updateInternshipDetails($candidate_id, $data_to_update);
    }

    //Accessing the bank_account table
    if (getDBRowID($candidate_id, 'bank_account') == 0){
        $last_id = addBankDetails($data_to_update);
    } else {
        $last_id = updateBankDetails($candidate_id, $data_to_update);
    }

//    if($last_idA && $last_idB && $last_idC && $last_idD)
    if ($last_id)
    {
        $_SESSION['success'] = "Partner Representative details updated successfully!";
        //Redirect to the listing page,
        header('location: candidates.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    } else {
        $_SESSION['failure'] = "Partner Representative details NOT  updated!";
        //Redirect to the listing page,
        header('location: candidates.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();        
    }
}


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
        <h2 class="page-header">Update Partner Representative Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
//            require_once('./forms/candidate_form_payroll.php'); 
        require_once('./forms/candidate_form_payroll.php'); 
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>