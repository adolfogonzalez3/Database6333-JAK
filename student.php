<?php
// Session stuff

// $user = $_POST['user'];
// Connect to database
require_once 'DatabaseConnect/db_connect.php';
if ($mysqli = DB_CONNECT()) {
    if ($stmt = $mysqli->prepare("SELECT name FROM person WHERE id = ?")) {
        $user = 3;
        $stmt->bind_param("i", $user);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows === 0)
            exit("No user with id $user exists");
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $stmt->close();
    } else {
        exit('Statement failed');
    }
} else {
    exit('Database failed to connect');
}
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
        <button onclick="createProject()">View Projects</button> <br>
        <br><br>
        <div id="formDiv"></div>
        
        <script type="text/javascript">
            function createProject() {
                window.location.href = "projects.php";
            }
        </script>
    </body>
</html>