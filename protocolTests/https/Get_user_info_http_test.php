<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();


echo '<br/>Get_user_info <br/>';
$get_user_info = new Get_user_info($config);
$get_user_info->setRequestOxdId($_SESSION['oxd_id']);
$get_user_info->setRequestAccessToken($_SESSION['access_token']);
$get_user_info->setRequest_protection_access_token($_SESSION['protection_access_token']);
$get_user_info->request();
print_r($get_user_info->getResponseObject());



