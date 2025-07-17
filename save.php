<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["image"])) {
        $data = $_POST["image"];
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $decodedData = base64_decode($data);
        $fileName = 'captures/' . uniqid() . '.png';

        if (!file_exists('captures')) {
            mkdir('captures', 0777, true);
        }

        if (file_put_contents($fileName, $decodedData)) {
            echo "Saved: " . $fileName;
        } else {
            echo "Error saving file.";
        }
    } else {
        echo "No image data received.";
    }
} else {
    echo "Invalid request.";
}
?>
