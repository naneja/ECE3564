<?php
$allowed_extensions = ['jpg', 'jpeg', 'png', 'mp4', 'pdf', 'txt'];

function handle_upload($file, $label) {
    global $allowed_extensions;

    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        echo "$label: No file uploaded.<br>";
        return;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "$label: Upload error code " . $file['error'] . "<br>";
        return;
    }

    $filename = basename($file['name']);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_extensions)) {
        echo "$label: Invalid file type ($ext).<br>";
        return;
    }

    $safe_name = uniqid() . "_" . $filename;
    $target_path = __DIR__ . "/" . $safe_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        echo "$label: File uploaded successfully as $safe_name<br>";
    } else {
        echo "$label: Failed to move uploaded file<br>";
    }
}

handle_upload($_FILES['file1'], 'File 1');
handle_upload($_FILES['file2'], 'File 2');
?>
