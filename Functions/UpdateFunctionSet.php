<?php
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    /*
    * Create a student given the required fields.
    * 
    * Inserts a tuple into the person table and then inserts into the student
    * table.
    * conn (mysqli Connection): A connection to the database.
    * username (String): The user's username at max 32 characters.
    * password (String): The user's password, currently unconstrained.
    */
    function createPerson($conn, $username, $password) {
        $sqlperson = "INSERT INTO person (username, passwordHash, joined) values (?, ?, ?)";
        $stmt = $conn->prepare($sqlperson);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $date = date("Y-m-d");
        $stmt->bind_param("sss", $username, $passwordHash, $date);
        if (!$stmt->execute()) {
            $stmt->close();
            return FALSE;
        }
        $stmt->close();
        return $conn->insert_id;
    }

    /*
    * Create a student given the required fields.
    * 
    * Inserts a tuple into the person table and then inserts into the student
    * table.
    * conn (mysqli Connection): A connection to the database.
    * username (String): The user's username at max 32 characters.
    * password (String): The user's password, currently unconstrained.
    * major (String): The user's major at max 32 characters.
    * classification (String): The user's class classification.
    */
    function createStudent($mysqli, $username, $password, $major, $classification) {
        
        


    }
?>