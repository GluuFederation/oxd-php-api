<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$logout = new Logout();
$logout->setRequestOxdId($_SESSION['oxd_id']);
$logout->setRequest_protection_access_token($_SESSION['protection_access_token']);
$logout->setRequestPostLogoutRedirectUri(Oxd_RP_config::$post_logout_redirect_uri);
$logout->request();

echo $logout->getResponseJSON();

