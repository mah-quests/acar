<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';

// Sanitize if you want
$var = 1;
$candidate_id = filter_input(INPUT_GET, 'candidate_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = filter_input_array(INPUT_POST);
    $id_number=$data_to_store['id_number'];

    if(checkIfCheckedIn($id_number,'time_in') == 0){

    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $data_to_store['check_in_date'] = date('Y-m-d');
    $data_to_store['check_in_time'] = date('H:i:s');
    $data_to_store['ip_address'] = getUserIP();
    $check_in_time=data_to_store['check_in_time'];
    
    $db = getDbInstance();
    $last_id = $db->insert ('time_in', $data_to_store);
    
    if($last_id){
        $_SESSION['success'] = "Time-In checked in successfully!";
        header('location: candidate_in_today.php');
        exit();
        } 
    }else{
        $_SESSION['failure'] = "Candidate already checked in today!";
        header('location: candidate_in_today.php');
        exit();        
    } 
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $candidate_id);
    //Get data to pre-populate the form.
    $candidate = $db->getOne("candidates");
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Confirm Check In</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/check_in_out.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>