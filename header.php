<?php

$drupal = array();
$ckan = array();
$solr = array();

$string = file_get_contents("../env/drupal.json");

$drupal=json_decode($string,true);

?>
