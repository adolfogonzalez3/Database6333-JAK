<?php
// Session stuff

require_once '/../DatabaseConnect/db_connect.php';

function createProject() {
    if ($mysqli = DB_CONNECT()) {
        // SQL statement needs to be finalized.
        if ($stmt = $mysqli->prepare("INSERT INTO project (startDate, endDate, leadID, name) values (?, ?, ?, ?)")) {
            $stmt->bind_param("ssss", $_POST['startDate'], $_POST['endDate'], $_POST['leadID'], $_POST['name']);
            if($stmt->execute()) {
                echo "Project created successfully!<br>";
            } else {
                echo "Something went wrong...";
                return;
            }
            $stmt->close();
        } else {
            echo "Something went wrong...";
            return;
        }
    } else {
        echo "Something went wrong...";
    }
}

if (isset($_POST['startDate'], $_POST['endDate'], $_POST['leadID'], $_POST['name'])) {
    createProject();
}

echo '<br><br>Redirecting...';
?>

<html>
    <meta http-equiv="refresh" content="10;url='../faculty.php'">
</html>