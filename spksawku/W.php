<?php
//query untuk menghimpun data bobot menjadi array

$sql = "SELECT bobot FROM criteria ORDER BY kdKriteria";
$result = $db->query($sql);
$i = 0;
$W = array(); 
while ($row = $result->fetch_object()) {
    $W[] = $row->bobot;
}
?>