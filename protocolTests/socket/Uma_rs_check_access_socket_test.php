<?php
namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$uma_rs_authorize_rpt = new Uma_rs_check_access();
$uma_rs_authorize_rpt->setRequestOxdId($_SESSION['oxd_id']);
$uma_rs_authorize_rpt->setRequestRpt('612bbd7d-ad30-4d1c-9909-00ce5caee44d_A060.8006.C671.AEDD.1545.84FA.05E5.06A3');
$uma_rs_authorize_rpt->setRequestPath("https://client.example.com/socket/api.php");
$uma_rs_authorize_rpt->setRequestHttpMethod("POST");
$uma_rs_authorize_rpt->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rs_authorize_rpt->request();

var_dump($uma_rs_authorize_rpt->getResponseObject());

$_SESSION['uma_ticket'] = $uma_rs_authorize_rpt->getResponseTicket();
