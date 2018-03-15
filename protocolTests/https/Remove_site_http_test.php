<?php

namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();
$remove_site = new Remove_site($config);

$remove_site->setRequestOxdId($_SESSION['oxd_id']);
$remove_site->setRequest_protection_access_token($_SESSION['protection_access_token']);
$remove_site->request();

print_r($remove_site->getResponseObject());

