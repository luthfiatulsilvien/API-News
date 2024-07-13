<?php
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$response = [];

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna
    $query = "SELECT id, username, password, email FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if ($user && password_verify($password, $user['password'])) {
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
            $response['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not found';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
