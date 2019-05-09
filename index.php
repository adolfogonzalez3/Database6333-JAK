<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/ValidationFunctionSet.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($conn = DB_CONNECT()) {
    if (login_check($conn) == true) {
        header("Location: faculty.php");
    }
}

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($conn = DB_CONNECT()) {
        if (login($conn, $username, $password)) {
            header('Location: faculty.php');
        } else {
            header("Location: index.php?error=2");
        }
    } else {
        header("Location: index.php?error=1");
    }
}

?>

<html>
    <head>
        <title>JAK Login</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <div class="main">
        <h1>JAK</h1>
        <h2>Login</h2>
        <form method="post" id="loginForm" autocomplete="off">
            <div id="inputName">Username:</div>
            <input class="form-input input-login" type="text" name="username" id="username" required />
            <div id="inputName">Password:</div>
            <input class="form-input input-login" type="password" name="password" id="password" required /><br><br>
            <input class="form-input input-submit" type="submit" value="Login" />
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == 1)
                echo '<div class="error">Error Logging In!</div>';
            elseif ($_GET["error"] == 2)
                echo '<div class="error">Wrong username or password.</div>';
        }
        ?>
            
            </div>

    </body>
</html>
