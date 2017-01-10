<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once('includes/constants.php');
require_once('includes/functions.php');
require_once('includes/Database.php');
require_once('includes/DatabaseObject.php');
include_once('includes/pdfDB.php');
include_once('includes/BusinessplandetailModel.php');
global $currentUrl;
$currentUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
global $currentPage;
$currentPage = basename($_SERVER['SCRIPT_NAME']);

?>