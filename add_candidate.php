<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
require_once './func/functions.php';


//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = filter_input_array(INPUT_POST);
    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $data_to_store['updated_at'] = date('Y-m-d H:i:s');
    $data_to_store['passwd'] = md5($data_to_store['passwd']);
    $idNumber = $data_to_store['id_number'];

    // check if the candidate exist
    if(checkIDNumber($idNumber) == 0 )
    {
           // $id_number = $data_to_store['id_number'];
           // deleteAll($id_number);
           
           $_SESSION['success'] = "Partner Representative added successfully!" ;
           
          
           $last_idA = addCandidateData($data_to_store);
           $last_idB = addBankDetails($data_to_store);
           $last_idC = addInternshipDetails($data_to_store);
           
           header('location: results.php');
           exit();

    } else //error msg if candidate exits
    {
        $_SESSION['failure'] = "Failed to add a Partner Representative, already exists, Please enter a new ID number! ";
           header('location: results.php');
           exit();  
    }   
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add Partner Representative</h2>
            
        </div>
        
</div>
    <form class="form" action="" method="post"  id="candidate_form" enctype="multipart/form-data">
       <?php  include_once('./forms/candidate_form_payroll.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#candidate_form").validate({
       rules: {
            first_names: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>