<?php
header('Content-Type: application/json');

if (isset($_FILES['image']) && isset($_POST['description'])) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo json_encode([
            "success" => true,
            "filePath" => $targetFile,
            "description" => htmlspecialchars($_POST['description'])
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to upload file."
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "No file or description received."
    ]);
}
?>
