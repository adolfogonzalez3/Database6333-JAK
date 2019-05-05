<?php

    /**
     * Checks for the existence of tuples with IDs.
     * 
     * Checks a table named $name for a tuple with ID = $ID.
     * 
     * Return (BOOL): TRUE if found else FALSE
     */
    function checkExist($conn, $name, $ID)
    {
        $Q = $conn->query("select * from ".$name." where ID=".$ID);
        return !empty($Q);
    }

    /**
     * Checks if ID belongs to student.
     * 
     * Checks if a person ID belongs to a student.
     * 
     * Return (BOOL): TRUE if ID belongs to student else FALSE
     */
    function isStudent($conn, $ID)
    {
        return checkExist($conn, 'student', $ID);
    }
?>