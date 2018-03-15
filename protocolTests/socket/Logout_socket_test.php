<?php
namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$logout = new Logout();
$logout->setRequestOxdId($_SESSION['oxd_id']);
$logout->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$logout->setRequestIdToken($_SESSION['user_oxd_access_token']);
$logout->setRequestSessionState($_SESSION['session_states']);
$logout->setRequestState($_SESSION['states']);
$logout->setRequest_protection_access_token($_SESSION['protection_access_token']);
$logout->request();

session_destroy();
echo $logout->getResponseHtml();

