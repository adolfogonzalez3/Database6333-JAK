<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/login.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($mysqli = DB_CONNECT()) {
    if (login_check($mysqli) == true) {
        header("Location: faculty.php");
    }
}

?>

<html>
    <head>
        <title>JAK Login</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Login</h2>
        <form action="Functions/login.php" method="post" id="loginForm" autocomplete="off">
            <div id="inputName">Username:</div>
            <input type="text" name="username" id="username" />
            <div id="inputName">Password:</div>
            <input type="password" name="password" id="password" /><br><br>
            <input type="submit" value="Login" />
        </form>
        <?php
        if (isset($_GET["error"])) {
            echo '<div class="error">Error Logging In!</div>';
        }
        ?>

    </body>
</html>
