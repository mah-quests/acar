<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
 

// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if($_SESSION['admin_type']!='super'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
    }
    
    $db = getDbInstance();
    $db->where('id', $del_id);
    $stat = $db->delete('admin_accounts');
    if ($stat) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: results.php');
        exit;
    }
}