<?php

namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$remove_site = new Remove_site();

$remove_site->setRequestOxdId($_SESSION['oxd_id']);
$remove_site->setRequest_protection_access_token($_SESSION['protection_access_token']);
$remove_site->request();

print_r($remove_site->getResponseObject());

