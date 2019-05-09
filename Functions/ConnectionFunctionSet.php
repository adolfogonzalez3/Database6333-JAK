<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'jak');


/**
 * Create a connection with a database.
 * 
 * Connects to a mysql database using mysqli.
 */
function createMysqliConnection($host_name, $user_name, $password, $database) {
    @$conn = new mysqli($host_name, $user_name, $password, $database);
    if (!is_null($conn->connect_error)) {
        return false;
    }
    return $conn;
}

/*
 * Create a connection with the JAK database.
 * 
 * Connects to a mysql database using mysqli.
 */
function DB_CONNECT() {
    return createMysqliConnection(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}

?>