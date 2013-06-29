<?php

$self = 'drupal';

$file = file_get_contents('services.json');
$connects = json_decode($file,true);

$instances = array();

foreach($connects as $instance) {
	list($file) = glob('../env/'.$instance.'*.json'); 
	$json = file_get_contents($file);
	$instances[$instance] = json_decode($json,true);
}


function genrandom() {
  $characters = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ123456789';
  $string = '';
  for ($i = 0; $i < 20; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $string;
}

?>
