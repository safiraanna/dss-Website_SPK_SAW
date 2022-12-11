<?php
require "include/conn.php";

$kdKecamatan = $_POST['kdKecamatan'];
$kdKriteria = $_POST['criteria'];
$nilai = $_POST['nilai'];

$sql = "INSERT INTO evaluations values ('$kdKecamatan','$kdKriteria','$nilai')";
$result = $db->query($sql);

if ($result === true) {
    header("location:./matrik.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
