<?php

if(!isset($_SESSION)){
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 0);

defined('APP_PATH') || define('APP_PATH', dirname(__FILE__).'/');
defined('UPLOADS') || define('UPLOADS', dirname(__FILE__).'/uploads');
defined('HR_MODULE') || define('HR_MODULE', dirname(__FILE__).'/modules/HR/application');
defined('EMP_MODULE') || define('EMP_MODULE', dirname(__FILE__).'/modules/EMP/application');
defined('CUST_MODULE') || define('CUST_MODULE', dirname(__FILE__).'/modules/CUST/application');

date_default_timezone_set('Asia/Calcutta');

//requiring library files
require 'library/bootstrap.php';
require 'library/controller.php';
require 'library/Model.php';
require 'library/view.php';
require 'library/Session.php';
require 'library/paths.php';

$bootstrap = new Bootstrap();
?>