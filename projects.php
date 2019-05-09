<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/ValidationFunctionSet.php';
require_once 'Functions/RetrievalFunctionSet.php';
require_once 'Functions/ConstructionFunctionSet.php';

if(!isset($_SESSION)) {
    session_start();
}

if ($conn = DB_CONNECT()) {
    if (!login_check($conn)) {
        header("Location: index.php");
    }
}
?>

<html>
    <head>
        <title>Website Title</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Projects Page</h2>
        
        <button onclick="homePage()">Home Page</button>
        <br><br>
        
        <?php
            $ID = $_SESSION['user_id'];
            $rows = getUserProjects($conn, $ID);
            $html = buildTableFromSet($rows);
            echo($html);
        ?>
        
        <script type="text/javascript">
            function homePage() {
                // Need to distinguish between Students and Faculty
                // Probably can make a session cookie or something to handle that
                window.location.href = "faculty.php";
            }
        </script>
    </body>
</html>