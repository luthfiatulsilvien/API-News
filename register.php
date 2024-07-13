<?php
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$response = [];

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Query untuk menyimpan data pengguna
    $query = "INSERT INTO pengguna (username, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($koneksi, $query)) {
        $response['status'] = 'success';
        $response['message'] = 'User registered successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to register user';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
