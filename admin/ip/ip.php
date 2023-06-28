<?php
require 'conn.php';

// Get the visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Get the URL of the current page
$current_url = $_SERVER['REQUEST_URI'];
$computer_name = gethostbyaddr($ip_address);

// Check if the URL contains a referrer parameter
if (isset($_GET['referrer'])) {
    // If a referrer parameter is present, use it as the referrer URL
    $referrer_url = $_GET['referrer'];
} else {
    // Otherwise, use the previous page URL as the referrer URL
    $referrer_url = isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : "";
}

// Store the current page URL in the session for the next page load
$_SESSION['previous_page'] = $current_url;

// Insert the data into the visitors table
$stmt = $pdo->prepare("INSERT INTO visitors (ip_address, computername, referer_url) VALUES (:ip_address, :computer_name, :referrer_url)");
$stmt->bindParam(":ip_address", $ip_address);
$stmt->bindParam(":computer_name", $computer_name);
$stmt->bindParam(":referrer_url", $referrer_url);
if ($stmt->execute()) {
    // echo "New record created successfully";
} else {
    echo "Error: " . $stmt->errorInfo();
}
?>