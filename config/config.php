<?php 

//Note: This file should be included first in every php page.

define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER','acar');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));


require_once BASE_PATH.'/lib/MysqliDb.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
*/

define('DB_HOST', "localhost");
define('DB_USER', "acar");
define('DB_PASSWORD', "acar");
define('DB_NAME', "acar");

/**
* Get instance of DB object
*/
function getDbInstance()
{
	return new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
}

function getConnection(){
	return mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
}