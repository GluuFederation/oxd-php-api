<?php
namespace oxdrp;

require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
$config = include(__DIR__ . '/../../src/oxdrp/oxdHttpConfig.php');

session_start();

$uma_rp_get_rpt = new Uma_rp_get_rpt();
$uma_rp_get_rpt->setRequest_oxd_id($_SESSION['oxd_id']);
$uma_rp_get_rpt->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rp_get_rpt->setRequest_ticket('c368119b-b164-4515-a605-99507e83c470');
$uma_rp_get_rpt->setRequest_state('i7lmjbnfidkkubooum46a10ojr');
$uma_rp_get_rpt->request();

var_dump($uma_rp_get_rpt->getResponseObject());

$_SESSION['uma_rpt']= $uma_rp_get_rpt->getResponseRpt();
echo $uma_rp_get_rpt->getResponseRpt();

