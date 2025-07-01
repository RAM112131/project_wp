<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pendakian_ciremai";

$connection = mysqli_connect(hostname: $db_host, username: $db_user, password: $db_pass, database: $db_name);

if(!$connection){
    echo "Koneksi Gagal! :". mysqli_connect_error();
}
?>