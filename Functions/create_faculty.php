<?php
// Session stuff

require_once '/../DatabaseConnect/db_connect.php';

function createFaculty() {
    if ($mysqli = DB_CONNECT()) {
        // SQL statement needs to be finalized.
        if ($stmt = $mysqli->prepare("INSERT INTO person (name, passwordHash, joined) values (?, ?, ?)")) {
            $name = $_POST['name'];
            $passwordHash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $joined = date("Y-m-d");
            $stmt->bind_param("sss", $name, $passwordHash, $joined);
            if($stmt->execute()) {
                echo "Faculty user created successfully!<br>";
                // Get their ID
                $stmt->close();
                $stmt = $mysqli->prepare("SELECT id FROM person WHERE name = ? AND passwordHash = ?");
                // DON'T LIKE THE WAY I HAVE TO GET THE ID
                $stmt->bind_param("ss", $name, $passwordHash);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $id = $row['id'];
                    echo "The faculty's ID is $id<br>";
                }
                $stmt->close();
                $stmt = $mysqli->prepare("INSERT INTO faculty VALUES (?, ?)");
                $stmt->bind_param("is", $id, $_POST['department']);
                $stmt->execute();
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

if (isset($_POST['name'], $_POST['department'], $_POST['pass1'], $_POST['pass2'])) {
    createFaculty();
}

echo '<br><br>Redirecting...';
?>

<html>
    <meta http-equiv="refresh" content="10;url='../faculty.php'">
</html>