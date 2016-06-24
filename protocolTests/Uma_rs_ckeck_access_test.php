<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$uma_rs_authorize_rpt = new Uma_rs_check_access();
$uma_rs_authorize_rpt->setRequestOxdId($_SESSION['oxd_id']);
$uma_rs_authorize_rpt->setRequestRpt($_SESSION['uma_rpt']);
$uma_rs_authorize_rpt->setRequestPath("/uma/library");
$uma_rs_authorize_rpt->setRequestHttpMethod("GET");
$uma_rs_authorize_rpt->request();

var_dump($uma_rs_authorize_rpt->getResponseObject());

