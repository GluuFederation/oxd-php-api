<?php

namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();
$get_protection_access_token = new Get_client_access_token();
$get_protection_access_token->setRequestOpHost(Oxd_RP_config::$op_host);
$get_protection_access_token->setRequest_oxd_id($_SESSION['oxd_id']);
$get_protection_access_token->setRequest_client_id($_SESSION['client_id']);
$get_protection_access_token->setRequest_client_secret($_SESSION['cleint_secret']);

$get_protection_access_token->request();
$_SESSION['protection_access_token'] = $get_protection_access_token->getResponse_access_token();
print_r($get_protection_access_token->getResponseObject());

