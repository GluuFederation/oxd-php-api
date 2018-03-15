<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$get_access_token_by_refresh_token = new Get_access_token_by_refresh_token($config);
$get_access_token_by_refresh_token->setRequestOxdId($_SESSION['oxd_id']);
$get_access_token_by_refresh_token->setRequestRefreshToken($_SESSION['refresh_token']);
$get_access_token_by_refresh_token->setRequest_protection_access_token($_SESSION['protection_access_token']);
$get_access_token_by_refresh_token->request();
$_SESSION['access_token'] = $get_access_token_by_refresh_token->getResponseAccessToken();
$_SESSION['refresh_token'] = $get_access_token_by_refresh_token->getResponseRefreshToken();
print_r($get_client_access_token->getResponseData());

