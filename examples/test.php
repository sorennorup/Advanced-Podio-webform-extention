<?php
require '../PodioConnect.php';
$podio_connection = new PodioConnect(19412331);

$res = PodioItem::filter(19412331);

  $appField = PodioAppField::get(19412331,154285328);

  if($appField->config['settings']['options'][0]['text']=='Ja'){
    echo 'yes det passer';
    };
 



?>