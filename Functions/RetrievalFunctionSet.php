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

?>