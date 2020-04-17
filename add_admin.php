<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once './func/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    //Password should be md5 encrypted
    $data_to_store['passwd'] = md5($data_to_store['passwd']);
    //$last_id = $db->insert ('admin_accounts', $data_to_store);
    $last_id = $data_to_store['user_name'];
    if (checkUserName($user_name) == 0){
        //Only super admin is allowed to access this page
        if ($_SESSION['admin_type'] == 'super') {
            
        	
            try{
                
                    $last_id = addAdminAccounts($data_to_store);
                
                if(!$last_id)
                {
                    $_SESSION['failure'] = "Oops! Something went wrong!!!";
                	header('location: resultsA.php');
                	exit();
                	
                } else
                {
                	$_SESSION['success'] = "Admin user added successfully!";
                	header('location: resultsA.php');
                	exit();
                }
            }
                //catch exception
            catch(Exception $e) {
                
              echo 'Message: ' .$e->getMessage();
            }
               

           
        } else
        {
             // show permission denied message
            $_SESSION['failure'] = "you dot have permission to performthis action";
            header('location: resultsA.php');
            exit();
        }
    } else
    {
          // show permission denied message
            $_SESSION['failure'] = "userName already exist!!!";
            header('location: resultsA.php');
            exit();
    }
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add New Admin</h2>
		</div>
	</div>
	<!-- Success message -->
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/admin_users_form.php'; ?>
	</form>
</div>




<?php include_once 'includes/footer.php'; ?>