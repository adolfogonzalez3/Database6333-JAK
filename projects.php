<?php
require_once 'Functions/ConnectionFunctionSet.php';
require_once 'Functions/ValidationFunctionSet.php';
require_once 'Functions/RetrievalFunctionSet.php';

session_start();

if(!isset($_SESSION)) {
    session_start();
}

if ($conn = DB_CONNECT()) {
    if (!login_check($conn)) {
        header("Location: index.php");
    }
}

$projects = getUserProjects($conn, $_SESSION['user_id']);
?>

<html>
    <head>
        <title>Website Title</title>
    </head>
    <body>
        <h1>JAK</h1>
        <h2>Projects Page</h2>
        
        <button onclick="homePage()">Home Page</button>
        <br><br>
        
        <?php
            $conn = DB_CONNECT();
            $ID = $_SESSION['user_id'];
            $rows = getUserProjects($conn, $ID);
            $finfo = $rows->fetch_fields();
        ?>
        <table>
        <tr>
        <?php
            foreach ($finfo as $val) {
        ?>
                <th><?=$val->name?></th>
        <?php
            }
        ?>
            </tr>
        <?php
            while($row = $rows->fetch_row()) {
        ?>
                <tr>
        <?php
                foreach($row as $col) {
        ?>
                    <td><?=$col?></td>
        <?php
                }
        ?>
                </tr>
        <?php
            }
        ?>
        </table>
        
        <script type="text/javascript">
            var projects = <?php echo json_encode($projects); ?>;
            var selectElement = document.getElementById('projects');
            var i;
            for (i = 0; i < projects.length; i++) {
                var o = document.createElement('option');
                o.setAttribute('value', projects[i]);
                o.innerHTML = projects[i];
                selectElement.appendChild(o);
            }
            
            function homePage() {
                // Need to distinguish between Students and Faculty
                // Probably can make a session cookie or something to handle that
                window.location.href = "faculty.php";
            }
        </script>
    </body>
</html>