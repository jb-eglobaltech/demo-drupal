<?php

$self = 'drupal';
$connects = array("drupal", "ckan");

$instances = array();

foreach($connects as $instance) {
	list($file) = glob('../env/'.$instance.'*.json'); 
	$json = file_get_contents($file);
	$instances[$instance] = json_decode($json,true);
}

?>
