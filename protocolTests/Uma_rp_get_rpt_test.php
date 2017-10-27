<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$uma_rp_get_rpt = new Uma_rp_get_rpt();
$uma_rp_get_rpt->setRequest_oxd_id($_SESSION['oxd_id']);
$uma_rp_get_rpt->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rp_get_rpt->setRequest_ticket($_SESSION['ticket']);
$uma_rp_get_rpt->request();

var_dump($uma_rp_get_rpt->getResponseObject());

$_SESSION['uma_rpt']= $uma_rp_get_rpt->getResponseRpt();
echo $uma_rp_get_rpt->getResponseRpt();

