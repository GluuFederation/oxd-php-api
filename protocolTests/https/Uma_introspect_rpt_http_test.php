<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$umaIntrospectRpt = new Uma_introspect_rpt($config);
$umaIntrospectRpt->setRequest_oxd_id($_SESSION['oxd_id']);
$umaIntrospectRpt->setRequest_rpt("cdb4ad0d-7933-4c0a-a17f-88f729e0e5ef_3536.DF8B.2FB5.197F.2E9C.1A4B.C9DB.8037");
$umaIntrospectRpt->request();

echo $umaIntrospectRpt->getResponseJSON();

