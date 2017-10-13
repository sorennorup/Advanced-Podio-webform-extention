<?php
 ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
$str = file_get_contents('http://localhost:8886/advanced-webform-master/check.json');
$json = json_decode($str,true);

echo $json;



?>