<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$uma_rp_get_claims_gathering_url = new Uma_rp_get_claims_gathering_url();
$uma_rp_get_claims_gathering_url->setRequest_oxd_id($_SESSION['oxd_id']);
$uma_rp_get_claims_gathering_url->setRequest_ticket($_SESSION['ticket']);
$uma_rp_get_claims_gathering_url->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rp_get_claims_gathering_url->setRequest_claims_redirect_uri(Oxd_RP_config::$post_logout_redirect_uri);
$uma_rp_get_claims_gathering_url->request();
var_dump($uma_rp_get_claims_gathering_url->getResponseObject());

