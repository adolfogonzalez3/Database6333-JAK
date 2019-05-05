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
    *
    * Return (INT): ID of the new tuple.
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
    * Inserts a tuple into the student table.
    * conn (mysqli Connection): A connection to the database.
    * username (String): The user's username at max 32 characters.
    * password (String): The user's password, currently unconstrained.
    * major (String): The user's major at max 32 characters.
    * classification (String): The user's class classification.
    *
    * Return (INT): ID of the new tuple.
    */
    function createStudent($mysqli, $username, $password, $major, $classification) {
        
        


    }

    /*
    * Create a Faculty member given the required fields.
    * 
    * Inserts a tuple into the faculty table.
    * conn (mysqli Connection): A connection to the database.
    * username (String): The user's username at max 32 characters.
    * password (String): The user's password, currently unconstrained.
    * department (String): The user's department at max 32 characters.
    *
    * Return (INT): ID of the new tuple.
    */
    function createFaculty($mysqli, $username, $password, $department) {
        
        


    }

    /*
    * Create a project given the required fields.
    * 
    * Inserts a tuple into the project table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the project at most 64 characters.
    * leadID (String): The project's lead. Constrained to faculty.
    *
    * Return (INT): ID of the new tuple.
    */
    function createProject($mysqli, $name, $leadID) {
        
        


    }

    /*
    * Create an experiment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the project at most 64 characters.
    * leadID (String): The project's lead. Constrained to faculty.
    *
    * Return (INT): ID of the new tuple.
    */
    function createProject($mysqli, $name, $leadID) {
        
        


    }

?>