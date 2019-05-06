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

function getAllUsers($conn) {
    $stmt = $conn->prepare("SELECT username FROM person");
    $users = array();
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($users, $row['username']);
    }
    $stmt->close();
    return $users;
}

function getUserProjects($conn, $id) {
    $stmt = $conn->prepare("SELECT ID, startDate, endDate, leadID, name FROM workson W, project P WHERE W.projectID = P.id AND W.userid = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $results = $stmt->get_result();
    $stmt->close();
    return $results;
}

function getUserExperiments($conn, $id) {
    $stmt = $conn->prepare("SELECT E.ProjectID, experimentNo, startDate, category FROM experiment E, workson W WHERE E.ProjectID = W.ProjectID and W.UserID = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $results = $stmt->get_result();
    $stmt->close();
    return $results;
}

?>