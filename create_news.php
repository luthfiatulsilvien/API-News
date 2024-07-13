<?php
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$response = [];

if (isset($_POST['judul']) && isset($_POST['isi']) && isset($_POST['tanggal_terbit']) && isset($_FILES['gambar'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal_terbit = $_POST['tanggal_terbit'];

    // Handle the file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = $target_file;

            // Insert data into database
            $query = "INSERT INTO news (judul, gambar, isi, tanggal_terbit) VALUES ('$judul', '$gambar', '$isi', '$tanggal_terbit')";
            if (mysqli_query($koneksi, $query)) {
                $response['status'] = 'success';
                $response['message'] = 'News created successfully';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to create news';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to upload image';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'File is not an image';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
