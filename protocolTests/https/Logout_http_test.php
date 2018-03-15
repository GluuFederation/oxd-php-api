<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$logout = new Logout($config);
$logout->setRequestOxdId($_SESSION['oxd_id']);
$logout->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$logout->setRequestIdToken($_SESSION['id_token']);
$logout->setRequestSessionState($_SESSION['session_state']);
$logout->setRequestState($_SESSION['state']);
$logout->setRequest_protection_access_token($_SESSION['protection_access_token']);
$logout->request();

session_destroy();
echo $logout->getResponseJSON();

