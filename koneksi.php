<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'news_db';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if ($koneksi) {
    // echo 'Koneksi Berhasil';
} else {
    echo 'Koneksi Gagal';
    die();
}
