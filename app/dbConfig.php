<?php
date_default_timezone_set('Africa/Tunis');
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "insta";

//Create connection and select DB
try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
//newuser("hosscold","hossem147","hossem.cold@gmail.com","sfdsqgfsdgsqg","15-02-1999","online")
	
?>