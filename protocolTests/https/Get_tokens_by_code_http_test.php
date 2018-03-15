<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$get_tokens_by_code = new Get_tokens_by_code($config);
$get_tokens_by_code->setRequestOxdId($_SESSION['oxd_id']);
//getting code from redirecting url, when user allowed.
$get_tokens_by_code->setRequestCode($_GET['code']);
$get_tokens_by_code->setRequestState($_GET['state']);
$get_tokens_by_code->setRequest_protection_access_token($_SESSION['protection_access_token']);
$get_tokens_by_code->request();
$_SESSION['state'] = $_GET['state'];
$_SESSION['session_state'] = $_GET['session_state'];
$_SESSION['id_token'] = $get_tokens_by_code->getResponseIdToken();
$_SESSION['access_token'] = $get_tokens_by_code->getResponseAccessToken();
print_r($get_tokens_by_code->getResponseObject());

