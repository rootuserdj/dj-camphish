<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $deleted = [];
    foreach ($data['images'] as $img) {
        $filepath = __DIR__ . "/captures/" . basename($img);
        if (file_exists($filepath)) {
            unlink($filepath);
            $deleted[] = $img;
        }
    }
    echo json_encode(['success' => true, 'deleted' => $deleted]);
    exit;
}
echo json_encode(['success' => false]);
?>
