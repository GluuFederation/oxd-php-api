<?php

namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$update_site = new Update_site();

$update_site->setRequestAcrValues(Oxd_RP_config::$acr_values);
$update_site->setRequestOxdId($_SESSION['oxd_id']);
$update_site->setRequest_protection_access_token($_SESSION['protection_access_token']);
$update_site->setRequestAuthorizationRedirectUri(Oxd_RP_config::$authorization_redirect_uri);
$update_site->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$update_site->setRequestContacts(["test@test.test"]);
$update_site->setRequestGrantTypes(Oxd_RP_config::$grant_types);
$update_site->setRequestResponseTypes(Oxd_RP_config::$response_types);
$update_site->setRequestScope(Oxd_RP_config::$scope);

$update_site->request();

print_r($update_site->getResponseObject());

