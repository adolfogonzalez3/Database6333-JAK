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

?>