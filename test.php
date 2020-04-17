<?php 
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
require_once './func/functions.php';
require_once './func/chartFunctions.php';

include_once './includes/header.php';

?>

    <div class="row">

<?php
// First day of this month
echo (new DateTime('first day of this month'))->format('jS, F Y');

echo (new DateTime('2010-01-19'))
    ->modify('first day of this month')
    ->format('jS, F Y');
?>


    </div>

<?php include_once 'includes/footer.php'; ?>