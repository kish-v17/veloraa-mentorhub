<?php
// Allow CORS for local testing
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Signaling mechanism using files for simplicity (use WebSockets for real-world)
$signalingFolder = 'signaling_data/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Save SDP offer/answer
    if (isset($input['sdp']) && isset($input['code'])) {
        $filePath = $signalingFolder . $input['code'] . '.json';
        file_put_contents($filePath, json_encode($input, JSON_PRETTY_PRINT));
        echo json_encode(['status' => 'SDP saved']);
    }

    // Save ICE candidate
    if (isset($input['candidate']) && isset($input['code'])) {
        $filePath = $signalingFolder . $input['code'] . '.json';
        $data = json_decode(file_get_contents($filePath), true);
        $data['ice'][] = $input['candidate'];
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(['status' => 'ICE candidate saved']);
    }
}

// Handle GET requests to retrieve signaling data
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])) {
    $filePath = $signalingFolder . $_GET['code'] . '.json';
    if (file_exists($filePath)) {
        echo file_get_contents($filePath);
    } else {
        echo json_encode(['status' => 'No signaling data available']);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (file_exists($signalingFile)) {
        $data = json_decode(file_get_contents($signalingFile), true);
        
        // Check if an SDP offer exists
        if (isset($data['sdp']) && $data['sdp']['type'] == 'offer') {
            echo json_encode(['status' => 'Call in progress']);
        } else {
            echo json_encode(['status' => 'No active call']);
        }
    } else {
        echo json_encode(['status' => 'No signaling data available']);
    }
}

?>
