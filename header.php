<?php

$drupal = array();
$ckan = array();
$solr = array();

list($file) = glob('../env/drupal*.json'); 
$json = file_get_contents($file);

$drupal=json_decode($json,true);

?>
