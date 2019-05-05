<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/ValidationFunctionSet.php';
require_once 'Functions/UpdateFunctionSet.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($conn = DB_CONNECT()) {
    if (!login_check($conn)) {
        header("Location: index.php");
    }
}

if (isset($_POST['logout'])) {
    logout();
}

if ($_SESSION['user_type'] == 'faculty')
    header("Location: faculty.php");

$name = $_SESSION['username'];

?>

<html>
    <head>
        <title>Website Title</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Student Page</h2>
        <?php
        echo "<h3>Welcome, $name!</h3>";
        ?>
        <button onclick="viewProjects()">View Projects</button> <br>
        <form method="post">
            <input name='logout' hidden />
            <input type="submit" value="Logout"/>
        </form>
        <br>
        <div id="formDiv"></div>
        
        <script type="text/javascript">
            function viewProjects() {
                window.location.href = "projects.php";
            }
        </script>
    </body>
</html>