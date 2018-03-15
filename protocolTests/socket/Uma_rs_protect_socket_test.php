<?php
namespace oxdrp;
require_once __DIR__ . '/../../src/oxdrp/Autoload.php';
session_start();

$uma_rs_protect = new Uma_rs_protect();
$uma_rs_protect->setRequestOxdId($_SESSION['oxd_id']);

$uma_rs_protect->addConditionForPath(
                                                ["GET","POST"],
                                                ['https://client.example.com'], 
                                                ['https://client.example.com']
                                            );
$uma_rs_protect->addResource('https://client.example.com/socket/api.php');
$uma_rs_protect->setRequest_protection_access_token($_SESSION['protection_access_token']);
$uma_rs_protect->request();
echo '<br/>Uma_rs_protect<pre>';
var_dump($uma_rs_protect->getResponseObject());
echo '</pre><br/>';

