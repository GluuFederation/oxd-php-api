<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$uma_rp_authorize_rpt = new Uma_rp_authorize_rpt();
$uma_rp_authorize_rpt->setRequestOxdId($_SESSION['oxd_id']);
$uma_rp_authorize_rpt->setRequestRpt($_SESSION['uma_rpt']);
$uma_rp_authorize_rpt->setRequestTicket('ce2b9c5b-812b-40b6-98b4-28346c01db68');
$uma_rp_authorize_rpt->request();

var_dump($uma_rp_authorize_rpt->getResponseObject());

