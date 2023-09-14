<?php
// Database configuration
$dbHost = "localhost";       // Hostname or IP address of the MySQL server
$dbUsername = "root";    // MySQL username
$dbPassword = "";    // MySQL password
$dbName = "job";   // Name of the MySQL database

// Create a connection to the MySQL database
$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// start a php session

session_start();
// echo ('sucess');
