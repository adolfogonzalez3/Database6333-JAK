<?php

/**
 * Checks for the existence of tuples with IDs.
 * 
 * Checks a table named $name for a tuple with ID = $ID.
 * 
 * Return (BOOL): TRUE if found else FALSE
 */
function checkExist($conn, $name, $ID)
{
    $Q = $conn->query("select * from ".$name." where ID=".$ID);
    return !empty($Q);
}

/**
 * Checks if ID belongs to student.
 * 
 * Checks if a person ID belongs to a student.
 * 
 * Return (BOOL): TRUE if ID belongs to student else FALSE
 */
function isStudent($conn, $ID)
{
    return checkExist($conn, 'student', $ID);
}

/**
 * Logs user in
 * 
 * Return (BOOL): true if valid user and password
 * else false
 */
function login($conn, $username, $password) {
    if ($stmt = $conn->prepare("SELECT ID, username, passwordHash FROM person where username = ? LIMIT 1")) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();
        if ($stmt->num_rows == 1) {
            if (password_verify($password, $db_password)) {
                if (isStudent($conn, $username)) {
                    $_SESSION['user_type'] = 'student';
                } else {
                    $_SESSION['user_type'] = 'faculty';
                }
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
                $stmt->close();
                return true;
            } else
                $stmt->close();
                return false;
        } else
            $stmt->close();
            return false;
    } else
        return false;
}

/**
 * Checks if the appropriate user is logged in
 * 
 * Return (BOOL): true if appropriate user logged in
 * else false
 */
function login_check($conn) {
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $login_string = $_SESSION['login_string'];
        
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        
        if ($stmt = $conn->prepare("SELECT passwordHash FROM person where ID = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                $stmt->close();
                if (hash_equals($login_check, $login_string)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $stmt->close();
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function logout() {
    session_start();
    
    $_SESSION = array();
    $_params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    session_destroy();

    
    header('Location: index.php');
}

function userExists($conn, $username) {
    $sql = "SELECT * FROM person WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    } else {
        return true;
    }
}

function isStudent($conn, $username) {
    $sql = "SELECT username FROM person P JOIN student S ON(P.id = S.id)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($name);
    while ($stmt->fetch()) {
        if ($name == $username)
            return true;
    }
    return false;
}
?>