<?php


/**
 * Builds a table in HTML from a mysql result set.
 */
function buildTableFromSet($set) {
    $result = "";
    $finfo = $set->fetch_fields();
    $result .= "<table>\n";
    $result .= "<tr>\n";
    foreach ($finfo as $val) {
        $result .= "<th>".$val->name."</th>\n";
    }
    $result .= "</tr>\n";
    while($row = $set->fetch_row()) {
        $result .= "<tr>\n";
        foreach ($row as $val) {
            $result .= "<th>".$val."</th>\n";
        }
        $result .= "</tr>\n";
    }
    $result .= "</table>\n";
    return $result;
}

?>