<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$introspectAccessToken = new Introspect_access_token($config);
$introspectAccessToken->setRequest_oxd_id($_SESSION['oxd_id']);
$introspectAccessToken->setRequest_access_token($_SESSION['protection_access_token']);
$introspectAccessToken->request();

echo $introspectAccessToken->getResponseJSON();

