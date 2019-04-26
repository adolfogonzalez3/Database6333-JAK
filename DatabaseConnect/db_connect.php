<?php
require_once 'db_config.php';
function DB_CONNECT() {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if ($mysqli->connect_errno > 0) {
        return false;
    }
    return false;
}
?>