<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'jak');

/*
 * Create a connection with database.
 * 
 * Connects to a mysql database using mysqli.
 */
function DB_CONNECT() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_errno > 0) {
        return false;
    }
    return $conn;
}

?>