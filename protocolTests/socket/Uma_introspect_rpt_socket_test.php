<?php
namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$umaIntrospectRpt = new Uma_introspect_rpt();
$umaIntrospectRpt->setRequest_oxd_id($_SESSION['oxd_id']);
$umaIntrospectRpt->setRequest_rpt('612bbd7d-ad30-4d1c-9909-00ce5caee44d_A060.8006.C671.AEDD.1545.84FA.05E5.06A3');
$umaIntrospectRpt->request();

var_dump($umaIntrospectRpt->getResponseObject());

