<?php
// Database configuration 
$dbHost     = "localhost";
$dbUsername = "moradchalaby";
$dbPassword = "1993mro55";
$dbName     = "bayraktar";

// Create database connection 
$dbh = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection 
if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
}