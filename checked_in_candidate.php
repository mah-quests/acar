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
    //Get customer id form query string parameter.
    $candidate_id = filter_input(INPUT_GET, 'candidate_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);

    $id_number=$data_to_update['id_number'];
    $time_checked_in=$data_to_update['check_in_time'];

    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    
    $db = getDbInstance();
    $db->where('id',$candidate_id);
    $stat = $db->update('time_in', $data_to_update);

        if($stat){
            $_SESSION['success'] = "[$id_number] Candidate check-in record updated successfully!";
            //Redirect to the listing page,
            header('location: candidates_in.php');
            //Important! Don't execute the rest put the exit/die. 
            exit();
        } else {
            $_SESSION['failure'] = "Candidate has already check-in today, at $time_checked_in!";
            //Redirect to the listing page,
            header('location: candidates_in.php');
            //Important! Don't execute the rest put the exit/die. 
            exit();

        }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $candidate_id);
    //Get data to pre-populate the form.
    $candidate = $db->getOne("time_in");
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">View Check-In Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/view_time_in_out_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>