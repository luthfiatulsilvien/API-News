<?php
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$response = [];

if (isset($_POST['id_news'])) {
    $id_news = $_POST['id_news'];

    $query = "SELECT * FROM news WHERE id_news = $id_news";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $news = mysqli_fetch_assoc($result);
        if ($news) {
            $response['status'] = 'success';
            $response['data'] = $news;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'News not found';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to fetch news';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
