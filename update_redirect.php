<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $redirect = trim($data['redirect']);
    if (filter_var($redirect, FILTER_VALIDATE_URL)) {
        file_put_contents('redirect.txt', $redirect);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid URL']);
    }
    exit;
}
echo json_encode(['success' => false]);
?>
