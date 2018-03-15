<?php

namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$get_authorization_url = new Get_authorization_url();
$get_authorization_url->setRequestOxdId($_SESSION['oxd_id']);
$get_authorization_url->setRequestScope(Oxd_RP_config::$scope);
$get_authorization_url->setRequestAcrValues(Oxd_RP_config::$acr_values);
$get_authorization_url->addCustom_parameters("param1", "value1");
$get_authorization_url->addCustom_parameters("param2", "value2");
$get_authorization_url->setRequest_protection_access_token($_SESSION['protection_access_token']);
$get_authorization_url->request();
echo $get_authorization_url->getResponseAuthorizationUrl();

