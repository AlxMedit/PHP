<?php
/**
 * @Function for sanitizing data
 * @author
 */

function clearData($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
