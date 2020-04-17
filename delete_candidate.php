<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
require_once './func/functions.php';

$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: candidates.php');
        exit;

	}
    
    $candidate_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $candidate_id);
    $candidate_details = $db->getOne('candidates');
    //$admin_detail = $db->getOne('admin_account');
    $id_number = $candidate_details['id_number'];  
  //  $id_num = $admin_detail['id_number'];
    $status = deleteAll($id_number);
   // $adStatus = deleteAll($id_number);


    if ($status) 
    {

        $_SESSION['info'] = "Partner Representative $id_number deleted successfully!";
        header('location: results.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete Partner Representative $id_number";
    	header('location: results.php');
        exit;

    }
    
}