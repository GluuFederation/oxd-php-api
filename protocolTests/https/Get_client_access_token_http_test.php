<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$get_client_access_token = new Get_client_access_token($config);
$get_client_access_token->setRequestOpHost(Oxd_RP_config::$op_host);
$get_client_access_token->setRequest_client_id($_SESSION['client_id']);
$get_client_access_token->setRequest_client_secret($_SESSION['client_secret']);
$get_client_access_token->setRequest_scope(Oxd_RP_config::$scope);
$get_client_access_token->request();
$_SESSION['protection_access_token'] = $get_client_access_token->getResponse_access_token();
$_SESSION['refresh_token'] = $get_client_access_token->getResponse_refresh_token();
print_r($get_client_access_token->getResponseData());

