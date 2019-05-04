<?php
// Session stuff

require_once '/../DatabaseConnect/db_connect.php';

function createEquipment() {
    if ($mysqli = DB_CONNECT()) {
        // SQL statement needs to be finalized.
        if ($stmt = $mysqli->prepare("INSERT INTO equipment (name, category, location) values (?, ?, ?)")) {
            $stmt->bind_param("sss", $_POST['name'], $_POST['category'], $_POST['location']);
            if($stmt->execute()) {
                echo "Equipment created successfully!<br>";
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

if (isset($_POST['name'], $_POST['category'], $_POST['location'])) {
    createEquipment();
}

echo '<br><br>Redirecting...';
?>

<html>
    <meta http-equiv="refresh" content="10;url='../faculty.php'">
</html>