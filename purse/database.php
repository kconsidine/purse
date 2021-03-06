<?php

define("DB_HOSTNAME", '127.0.0.1');
define("DB_DATABASE", '');
define("DB_USERNAME", '');
define("DB_PASSWORD", '');	

function getPDOHandle() {
	$dsn = 'mysql:dbname='.DB_DATABASE.';host='.DB_HOSTNAME;
	try{
		$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
	}catch (PDOException $e){
		throw new Exception('Could not connect to database: '.$e->getMessage());
		return false;
	}
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $db;
}
