<?php
namespace oxdrp;
require_once __DIR__ . '/../src/oxdrp/Autoload.php';
session_start();

$uma_rs_protect = new Uma_rs_protect();
$uma_rs_protect->setRequestOxdId($_SESSION['oxd_id']);

$uma_rs_protect->addConditionForPath(["GET"],["http://vlad.umatest.com/dev/actions/view"], ["http://vlad.umatest.com/dev/actions/view"]);
$uma_rs_protect->addConditionForPath(["POST"],[ "http://vlad.umatest.com/dev/actions/add"],[ "http://vlad.umatest.com/dev/actions/add"]);
$uma_rs_protect->addConditionForPath(["DELETE"],["http://vlad.umatest.com/dev/actions/remove"], ["http://vlad.umatest.com/dev/actions/remove"]);
$uma_rs_protect->addResource('/uma/library');

$uma_rs_protect->request();
echo '<br/>Uma_rs_protect<pre>';
var_dump($uma_rs_protect->getResponseObject());
echo '</pre><br/>';

