<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();
session_destroy();
session_start();

$setup_client = new Setup_client($config);
$setup_client->setRequestOpHost(Oxd_RP_config::$op_host);
$setup_client->setRequestAcrValues(Oxd_RP_config::$acr_values);
$setup_client->setRequestAuthorizationRedirectUri(Oxd_RP_config::$authorization_redirect_uri);
$setup_client->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$setup_client->setRequestContacts(["test@test.test"]);
$setup_client->setRequestGrantTypes(Oxd_RP_config::$grant_types);
$setup_client->setRequestResponseTypes(Oxd_RP_config::$response_types);
$setup_client->setRequestScope(Oxd_RP_config::$scope);
$setup_client->addRequestClaimsRedirectUri(Oxd_RP_config::$authorization_redirect_uri);

$setup_client->request();
$_SESSION['oxd_id'] = $setup_client->getResponseOxdId();
$_SESSION['client_id'] = $setup_client->getResponse_client_id();
$_SESSION['client_secret'] = $setup_client->getResponse_client_secret();
print_r($_SESSION);

