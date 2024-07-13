<?php
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$query = "SELECT * FROM news";
$result = mysqli_query($koneksi, $query);

$response = [];

if ($result) {
    $news = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $news[] = $row;
    }
    $response['status'] = 'success';
    $response['data'] = $news;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to fetch news';
}

echo json_encode($response);
