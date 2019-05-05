<?php
require_once '/../DatabaseConnect/db_connect.php';

if (!isset($_SESSION)) {
    session_start();
}

function secure_session_start() {
    $session_name = 'secure_session_id';
    $secure = TRUE;
    $httponly = TRUE;
    
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name);
    session_start();
    session_regenerate_id();
}

function login($username, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT ID, name, passwordHash FROM person where name = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();
        if ($stmt->num_rows == 1) {
            if (password_verify($password, $db_password)) {
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
                return true;
            } else
                return false;
        } else
            return false;
    } else
        return false;
}

function login_check() {
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $login_string = $_SESSION['login_string'];
        
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        
        $mysqli = DB_CONNECT();
        
        if ($stmt = $mysqli->prepare("SELECT passwordHash FROM person where ID = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                
                if (hash_equals($login_check, $login_string)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $mysqli = DB_CONNECT();
    
    if (login($username, $password, $mysqli)) {
        header('Location: ../faculty.php');
    } else {
        header("Location: ../index.php?error=1");
    }
}


?>