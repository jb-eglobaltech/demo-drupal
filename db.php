<?php 

	ini_set('display_errors', 'on');
	include_once('header.php');

  	$dbhost = (string) $rds->DescribeDBInstancesResult->DBInstances[0]->DBInstance->Endpoint->Address;
  	$dbname = (string) $rds->DescribeDBInstancesResult->DBInstances[0]->DBInstance->DBName;
  	$dbuser = (string) $rds->DescribeDBInstancesResult->DBInstances[0]->DBInstance->MasterUsername;
  	$dbpassword = $dbuser;
  	$dbport = 3306;

	$constring = 'mysql:host='.$dbhost.';';
	$constring .= 'dbname='.$dbname.';';
	$constring .= 'port='.$dbport.';';
	$constring .= 'connect_timeout=15';

    $dbo = new PDO($constring,$dbuser,$dbpassword);
    $dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* Query */
	$sql = "SHOW TABLES FROM $dbname";

	$query = $dbo->prepare($sql);
        
    if ($query->execute()) {

		$results = array();
    	$results = $query->fetchAll();

    	$count = count($results);

    	if ($count) {			
			print_r($results);			
		} else {
			echo 'no tables found';		
		}

	}

?>

