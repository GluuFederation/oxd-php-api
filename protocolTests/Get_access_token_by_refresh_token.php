<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();


echo '<br/>Get_access_token_by_refresh_token <br/>';
$get_access_token_by_refresh_token = new Get_access_token_by_refresh_token();
$get_access_token_by_refresh_token->setRequestOxdId($_SESSION['oxd_id']);
$get_access_token_by_refresh_token->setRequest_protection_access_token($_SESSION['protection_access_token']);
$get_access_token_by_refresh_token->setRequestRefreshToken($_SESSION['refresh_token']);
$get_user_info->request();
$_SESSION['access_token'] = $get_access_token_by_refresh_token->getResponseAccessToken();
print_r($get_user_info->getResponseObject());



