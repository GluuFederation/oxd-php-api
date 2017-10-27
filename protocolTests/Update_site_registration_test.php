<?php

namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$update_site_registration = new Update_site_registration();

$update_site_registration->setRequestAcrValues(Oxd_RP_config::$acr_values);
$update_site_registration->setRequestOxdId($_SESSION['oxd_id']);
$update_site_registration->setRequest_protection_access_token($_SESSION['protection_access_token']);
$update_site_registration->setRequestAuthorizationRedirectUri(Oxd_RP_config::$authorization_redirect_uri);
$update_site_registration->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$update_site_registration->setRequestContacts(["test@test.test"]);
$update_site_registration->setRequestGrantTypes(Oxd_RP_config::$grant_types);
$update_site_registration->setRequestResponseTypes(Oxd_RP_config::$response_types);
$update_site_registration->setRequestScope(Oxd_RP_config::$scope);

$update_site_registration->request();

print_r($update_site_registration->getResponseObject());

