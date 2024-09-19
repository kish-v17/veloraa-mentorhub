<?php
// signaling.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$dir = 'signaling_data/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$code = isset($_GET['code']) ? $_GET['code'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    file_put_contents($dir . $code . '.json', json_encode($data));
    echo json_encode(['status' => 'OK']);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (file_exists($dir . $code . '.json')) {
        echo file_get_contents($dir . $code . '.json');
    } else {
        echo json_encode(['status' => 'No data']);
    }
}
