<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();


echo '<br/>Get_user_info <br/>';
$get_user_info = new Get_user_info();
$get_user_info->setRequestOxdId($_SESSION['oxd_id']);
$get_user_info->setRequestAccessToken($_SESSION['access_token']);
$get_user_info->request();
print_r($get_user_info->getResponseObject());



