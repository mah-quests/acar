<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';

// Sanitize if you want
$candidate_id = filter_input(INPUT_GET, 'company_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    
    $company_id = 1 ;
    $rowID = getCompanyDetailsRowOnEdit($candidate_id, 'admin_accounts');    
        if ($rowID == 0){
            $last_id = addCompanyDetails($data_to_store);
        } else {
            $last_id = updateCompanyDetails($company_id, $data_to_update);        
        }
    
//    if($last_idA && $last_idB && $last_idC && $last_idD)
    if ($last_id)
    {
        $_SESSION['success'] = 'Company details updated successfully!';
        //Redirect to the listing page,
        header('location: index.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    } else {
        $_SESSION['failure'] = 'Company details NOT  updated!';
        //Redirect to the listing page,
        header('location: index.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();        
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{

    //Get data to pre-populate the candidate part of the form.
    $company_id = 1 ;
    $db->where('id', $company_id);    
    $companyDetails = getCompanyDetailsRowOnEdit($company_id, 'business_infomation');

}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Company Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
        require_once('./forms/company_details_form.php'); 
        ?>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>