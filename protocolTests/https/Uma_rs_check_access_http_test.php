<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$uma_rs_authorize_rpt = new Uma_rs_check_access($config);
$uma_rs_authorize_rpt->setRequestOxdId($_SESSION['oxd_id']);
$uma_rs_authorize_rpt->setRequestRpt('cdb4ad0d-7933-4c0a-a17f-88f729e0e5ef_3536.DF8B.2FB5.197F.2E9C.1A4B.C9DB.8037');
$uma_rs_authorize_rpt->setRequestPath("https://client.example.com/socket/api.php");
$uma_rs_authorize_rpt->setRequestHttpMethod("POST");
$uma_rs_authorize_rpt->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rs_authorize_rpt->request();

var_dump($uma_rs_authorize_rpt->getResponseObject());

$_SESSION['uma_ticket'] = $uma_rs_authorize_rpt->getResponseTicket();
