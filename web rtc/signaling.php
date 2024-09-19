<?php
// signaling.php

session_start();
header('Content-Type: aspplication/json');

$file = 'signaling.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive offer or answer from the frontend
    $data = json_decode(file_get_contents('php://input'), true);

    // Save the signaling data to a file (this can be a database in a real app)
    if (isset($data['offer'])) {
        // Save offer
        file_put_contents($file, json_encode(['offer' => $data['offer']]));
        echo json_encode(['status' => 'offer saved']);
    } elseif (isset($data['answer'])) {
        // Save answer
        file_put_contents($file, json_encode(['answer' => $data['answer']]));
        echo json_encode(['status' => 'answer saved']);
    }
} else {
    // When client requests data (e.g., for pickup)
    if (file_exists($file)) {
        // Retrieve the signaling data from the file
        $signalingData = json_decode(file_get_contents($file), true);
        echo json_encode($signalingData);
    } else {
        echo json_encode(['error' => 'No signaling data']);
    }
}
?>
