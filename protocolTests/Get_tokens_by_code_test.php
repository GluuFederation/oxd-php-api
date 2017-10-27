<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$get_tokens_by_code = new Get_tokens_by_code();

$get_tokens_by_code->setRequestOxdId($_SESSION['oxd_id']);
$get_tokens_by_code->setRequest_protection_access_token($_SESSION['protection_access_token']);
//getting code from redirecting url, when user allowed.
$get_tokens_by_code->setRequestCode($_GET['code']);
$get_tokens_by_code->setRequestState($_GET['state']);

$get_tokens_by_code->request();
$_SESSION['id_token'] = $get_tokens_by_code->getResponseIdToken();
$_SESSION['access_token'] = $get_tokens_by_code->getResponseAccessToken();
$_SESSION['refresh_token'] = $get_tokens_by_code->getResponseRefreshToken();
print_r($get_tokens_by_code->getResponseObject());

