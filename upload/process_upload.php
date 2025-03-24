<?php
$allowed_extensions = [
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'mp4' => 'video/mp4',
    'mov' => 'video/quicktime',
    'avi' => 'video/x-msvideo',
    'txt' => 'text/plain',
    'pdf' => 'application/pdf',
];

$upload_dir = "uploads/";

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    foreach ($_FILES['files']['tmp_name'] as $index => $tmp_name) {
        $original_name = $_FILES['files']['name'][$index];
        $file_type = $_FILES['files']['type'][$index];
        $file_tmp = $_FILES['files']['tmp_name'][$index];
        $file_error = $_FILES['files']['error'][$index];
        $file_size = $_FILES['files']['size'][$index];

        $file_ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        if ($file_error !== UPLOAD_ERR_OK) {
            echo "Error uploading file: $original_name<br>";
            continue;
        }

        if (!array_key_exists($file_ext, $allowed_extensions)) {
            echo "File extension not allowed: $original_name<br>";
            continue;
        }

        // Use finfo to check real MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $real_mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);

        if ($real_mime !== $allowed_extensions[$file_ext]) {
            echo "MIME type mismatch or not allowed: $original_name ($real_mime)<br>";
            continue;
        }

        $safe_name = uniqid() . "_" . basename($original_name);
        $target_path = $upload_dir . $safe_name;

        if (move_uploaded_file($file_tmp, $target_path)) {
            echo "File uploaded successfully: $original_name<br>";
        } else {
            echo "Failed to move uploaded file: $original_name<br>";
        }
    }
} else {
    echo "No files uploaded.";
}
?>
