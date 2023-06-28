<?php
	session_start();

	// Replace the variables below with your actual database credentials
	$host = 'localhost';
	$dbname = 'mod';
	$username = 'root';
	$password = '';

	// Connect to the database using PDO
	try {
	    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	}
?>
