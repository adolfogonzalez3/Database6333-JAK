<?php

/**
 * Add table tag to string.
 */
function addHTMLTable($html) {
    return "<table>".$html."</table>";
}

/**
 * Add table row tag to string.
 */
function addHTMLTableRow($html) {
    return "<tr>".$html."</tr>";
}

/**
 * Add table cell tag to string.
 */
function addHTMLTableCell($html) {
    return "<th>".$html."</th>";
}

/**
 * Builds a table in HTML from a mysql result set.
 */
function buildTableFromSet($set) {
    $finfo = $set->fetch_fields();
    $result = "";
    foreach ($finfo as $val) {
        $result .= addHTMLTableCell($val->name);
    }
    $result .= addHTMLTableRow($result);
    while($row = $set->fetch_row()) {
        $rowHTML = "";
        foreach ($row as $val) {
            $rowHTML .= addHTMLTableCell($val);
        }
        $result .= addHTMLTableRow($rowHTML);
    }
    return addHTMLTable($result);
}

?>