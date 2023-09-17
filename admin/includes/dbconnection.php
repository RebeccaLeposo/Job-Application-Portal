<?php
// DB credentials.
define('DB_HOST', 'sql113.infinityfree.com');
define('DB_USER', 'if0_35053151');
define('DB_PASS', '0MxcTDedSk');
define('DB_NAME', 'if0_35053151_job');
// Establish database connection.
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
