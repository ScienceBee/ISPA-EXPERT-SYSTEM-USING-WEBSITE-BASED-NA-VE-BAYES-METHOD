<?php

$koneksi = mysqli_connect('localhost','root','akmal1652002','kecerdasan_buatan');

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

?>