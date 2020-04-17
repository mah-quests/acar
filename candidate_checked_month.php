<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';


// Sanitize if you want
$candidate_id = filter_input(INPUT_GET, 'candidate_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;

$db_name='candidates';
$db = getDbInstance();

if($edit)
{
    $db->where('id', $candidate_id);
    //Get data to pre-populate the form.
    $candidate = $db->getOne($db_name);
    $id_number = $candidate['id_number'];

}
?>

<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Partner Representatives Month Check-In Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/monthly_check_in_out.php'); 
        ?>
        <div class="well text-left filter-form">
            <?php echo getAllCheckValues($id_number, 'time_in'); ?>
        </div>
        <?php
            //Include the common form for add and edit  
            require_once('./forms/check_out_part.php'); 
        ?>
        <div class="well text-left filter-form">
            <?php echo getAllCheckValues($id_number, 'time_out'); ?>
        </div>

    </form>

</div>

<?php include_once 'includes/footer.php'; ?>