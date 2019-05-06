<?php
/**
 * Get ID of user by name.
 */
function getUserByName($conn, $name) {
    $stmt = $conn->prepare("select * from person where username=?");
    $stmt->bind_param("s", $name);
    if(!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $results = $stmt->get_result();
    $stmt->close();
    return $results->fetch_row();
}


function getAllEquipmentOwnedByUser($conn, $ID) {
    $sql = "select * from equipment as E, EquipmentBelongsTo as B where E.ID=B.equipmentID and B.userID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);
    if(!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $results = $stmt->get_result();
    $stmt->close();
    return $results;
    //$ID = createFaculty($this->_conn, "test", "password", "CS");
    //$ID = createEquipment($this->_conn, "test", 0, "place");
}

?>