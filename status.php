<?php 
  header('Content-Type: application/json');
  ini_set('display_errors', 'on');
  include_once('header.php'); 

  $status = array("Green",
                  "Yellow",
                 );
  $statusMsg = array(ucwords($self)." server is ready for requests",
                     ucwords($self)." server is busy",
                     );

  $index = rand(0,1);

  $data = array("id" => rand(100000000, 999999999),
                "name" => $instances[$self]['name'],
                "status" => $status[$index],
                "message" => $statusMsg[$index]
               );

  print_r(json_encode($data, JSON_PRETTY_PRINT));

?>

