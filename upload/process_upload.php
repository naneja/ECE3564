<?php
$allowed_extensions = ['jpg', 'jpeg', 'png', 'mp4', 'pdf', 'txt'];

// Upload directory relative to this script
$upload_dir = __DIR__ . '/uploads/';

// Ensure upload directory exists
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        die("Failed to create upload directory.");
    }
}

// Check if upload directory is writable
if (!is_writable($upload_dir)) {
    die("Upload directory is not writable.");
}

function handle_upload($file, $label) {
    global $allowed_extensions, $upload_dir;

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

    $safe_name = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $filename);
    $target_path = $upload_dir . $safe_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        echo "$label: File uploaded successfully as $safe_name<br>";
    } else {
        echo "$label: Failed to move uploaded file.<br>";
    }
}

// Handle both file1 and file2
handle_upload($_FILES['file1'], 'File 1');
handle_upload($_FILES['file2'], 'File 2');
?>
