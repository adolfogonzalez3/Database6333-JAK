<?php
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
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
        $sql = "INSERT INTO person (username, passwordHash, joined) values (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $date = date("Y-m-d");
            $stmt->bind_param("sss", $username, $passwordHash, $date);
            if (!$stmt->execute()) {
                $stmt->close();
                return false; 
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
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
    function createStudent($conn, $username, $password, $major, $classification) {
        if (!($ID = createPerson($conn, $username, $password))) {
            return FALSE;
        }
        $sql = "INSERT INTO student (ID,major,classification) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $ID, $major, $classification);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return $ID;
    }

    /*
    * Create a Faculty member given the required fields.
    * 
    * Inserts a tuple into the person and faculty tables.
    * conn (mysqli Connection): A connection to the database.
    * username (String): The user's username at max 32 characters.
    * password (String): The user's password, currently unconstrained.
    * department (String): The user's department at max 32 characters.
    *
    * Return (INT): ID of the new tuple. Or FALSE on fail.
    */
    function createFaculty($conn, $username, $password, $department) {
        if (!($ID = createPerson($conn, $username, $password))) {
            return FALSE;
        }
        $sql = "INSERT INTO faculty (ID,department) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $ID, $department);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return $ID;
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
    function createProject($conn, $name, $leadID, $startDate, $endDate) {
        $stmt = $conn->prepare("INSERT INTO project (startDate,endDate,leadID,name) values (?,?,?,?)");
        $stmt->bind_param("ssis", $startDate, $endDate, $leadID, $name);
        if(!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        $id = $conn->insert_id;
        assignUserToProject($conn, $leadID, $id);
        return $id;
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
    function createExperiment($conn, $projectID, $category) {
        $sql = "INSERT INTO experiment (projectID,startDate,category) VALUES (?, ?,?)";
        $stmt = $conn->prepare($sql);
        $startDate = date("Y-m-d");
        $stmt->bind_param("iss", $projectID, $startDate, $category);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return $conn->insert_id;
    }

    /*
    * Create an environment given the required fields.
    * 
    * Inserts a tuple into the environment table.
    * conn (mysqli Connection): A connection to the database.
    * name (String): The name of the environment.
    * low (FLOAT or NULL): The minimum reward possible.
    * high (FLOAT or NULL): The maximum reward possible.
    * path (String): The path to the environment.
    *
    * Return (INT): ID of the newly created tuple. Or FALSE on fail.
    */
    function createEnvironment($conn, $name, $low, $high, $path) {
        $sql = "INSERT INTO environment (name,rewardLow,rewardHigh,path) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $startDate = date("Y-m-d");
        $stmt->bind_param("sdds", $name, $low, $high, $path);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return $conn->insert_id;
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
    function createEquipment($conn, $name, $category, $location) {
        $sql = "INSERT INTO equipment (name, category, location) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $name, $category, $location);
            if(!$stmt->execute()) {
                $stmt->close();
                return false;
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
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
    function createAgent($conn, $action, $observation, $path) {
        $sql = "INSERT INTO agent (actionSpace,observationSpace,path) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $action, $observation, $path);
            if(!$stmt->execute()) {
                $stmt->close();
                return false;
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
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
    function createModel($conn, $name, $category, $path) {
        $sql = "INSERT INTO model (name,category,path) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $name, $category, $path);
            if(!$stmt->execute()) {
                $stmt->close();
                return false;
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
    }


    /**
     * Assign equipment to faculty.
     */
    function assignEquipmentToFaculty($conn, $EquipmentID, $FacultyID) {
        $sql = "INSERT INTO EquipmentBelongsTo (EquipmentID,UserID) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $EquipmentID, $FacultyID);
            if(!$stmt->execute()) {
                $stmt->close();
                return false;
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    /**
     * Assign Person to Project.
     */
    function assignUserToProject($conn, $PersonID, $ProjectID) {
        $sql = "INSERT INTO workson (UserID,ProjectID) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $PersonID, $ProjectID);
            if(!$stmt->execute()) {
                $stmt->close();
                return false;
            }
            $stmt->close();
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    /*
    * Create a Faculty member given the required fields.
    * 
    * Inserts a tuple into the person and faculty tables.
    * conn (mysqli Connection): A connection to the database.
    * ID (Int): The ID of the project.
    *
    * Return (INT): ID of the new tuple. Or FALSE on fail.
    */
    function deleteProject($conn, $ID) {
        $sql = "DELETE FROM project where ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ID);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    }
?>