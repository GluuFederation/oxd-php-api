<?php

namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();
$register_site = new Setup_client();
$register_site->setRequestOpHost(Oxd_RP_config::$op_host);
$register_site->setRequestAcrValues(Oxd_RP_config::$acr_values);
$register_site->setRequestAuthorizationRedirectUri(Oxd_RP_config::$authorization_redirect_uri);
$register_site->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$register_site->setRequestContacts(["test@test.test"]);
$register_site->setRequestGrantTypes(Oxd_RP_config::$grant_types);
$register_site->setRequestResponseTypes(Oxd_RP_config::$response_types);
$register_site->setRequestScope(Oxd_RP_config::$scope);

$register_site->request();
$_SESSION['oxd_id'] = $register_site->getResponseOxdId();
$_SESSION['client_id'] = $register_site->getResponse_client_id();
$_SESSION['cleint_secret'] = $register_site->getResponse_client_secret();
print_r($register_site->getResponseObject());

