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
    * Return (INT): ID of the new tuple. Or FALSE on fail.
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
    * Return (INT): ID of the new tuple. Or FALSE on fail.
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
    * Return (INT): ID of the new tuple. Or FALSE on fail.
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
    * Return (INT): ID of the new tuple. Or FALSE on fail.
    */
    function createProject($mysqli, $name, $leadID) {
        
        


    }

    /*
    * Create an experiment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * projectID (String): The ID of the project the experiment is being run for.
    * category (INT): The type of experiment being run.
    *       0 - Classification
    *       1 - Reinforcement Learning
    *
    * Return (INT): Experiment number of newly created tuple. Or FALSE on fail.
    */
    function createExperiment($mysqli, $name, $leadID) {
        
    }

    /*
    * Create an experiment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the environment.
    * low (FLOAT or NULL): The minimum reward possible.
    * high (FLOAT or NULL): The maximum reward possible.
    * path (String): The path to the environment.
    *
    * Return (INT): Experiment number of newly created tuple. Or FALSE on fail.
    */
    function createExperiment($mysqli, $name, $low, $high, $leadID) {
        
    }

    /*
    * Create an equipment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the equipment at most 32 characters.
    * category (INT): The category of the equipment.
    *       0 - Desktop
    *       1 - Monitor
    *       2 - GPU
    *       3 - Monitor
    * location (String): A description of the location of the equipment.
    *
    * Return (INT): ID of newly created tuple. Or FALSE on fail.
    */
    function createEquipment($mysqli, $name, $category, $location) {
        
    }

    /*
    * Create an equipment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * action (String): The action space of the agent.
    *       Action space describes the range of action the agent may perform.
    *       ie
    *       Discrete(5) - May only perform five different actions
    *       Box(shape=(5,), low=-1., high=1.) - May perform actions by 
                outputting an array of 5 numbers bounded by 1. and -1.
    * observation (String): The observation space of the agent.
            Observation space uses the same types of spaces as action spaces.
            ie
            Box(shape=(5,), low=-1., high=1.) - May perform receive
                observations from an array of 5 numbers bounded by 1. and -1.
    * path (INT): The path to the agent's files.
    *
    * Return (INT): ID of newly created tuple. Or FALSE on fail.
    */
    function createAgent($mysqli, $action, $observation, $path) {
        
    }

    /*
    * Create an equipment given the required fields.
    * 
    * Inserts a tuple into the experiment table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the model at most 32 characters.
    * category (INT): The category of the model.
    *       0 - Classification
    *       1 - Reinforcement Learning
    * path (String): The path to the model's files.
    *
    * Return (INT): ID of newly created tuple. Or FALSE on fail.
    */
    function createModel($mysqli, $name, $category, $path) {
        
    }
?>