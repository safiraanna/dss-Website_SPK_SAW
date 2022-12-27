<?php
//koneksi dengan database

require "include/conn.php";

//mengumpulkan data dari field yang diinput

$kdKecamatan = $_POST['kdKecamatan'];
$kdKriteria = $_POST['criteria'];
$nilai = $_POST['nilai'];

//query sql untuk menambahkan data baru

$sql = "INSERT INTO evaluations values ('$kdKecamatan','$kdKriteria','$nilai')";
$result = $db->query($sql);

if ($result === true) {
    header("location:./matrik.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
