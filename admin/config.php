<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "tubes";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) die("gagal koneksi");