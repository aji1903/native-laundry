<?php
$host = "localhost";
$host_username = "root";
$host_password = "";
$db = "angkatan1_laundry";

$connect = mysqli_connect($host, $host_username, $host_password, $db);
if (!$connect) {
    echo "GAGAL NICHH";
};
