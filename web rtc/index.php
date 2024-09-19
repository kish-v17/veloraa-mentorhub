<?php
session_start();
require 'database/db.php'; // Database connection

// Fetch all users except the current user
$stmt = $dbh->prepare("SELECT U_Id, U_Fnm FROM user_tbl WHERE U_Id != :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']); // Skip the logged-in user
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Users</title>
</head>
<body>
    <h2>Call a User</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?php echo htmlspecialchars($user['U_Fnm']); ?>
                <button onclick="startCall(<?php echo $user['U_Id']; ?>)">Call</button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div id="videoContainer">
        <video id="localVideo" autoplay playsinline muted></video>
        <video id="remoteVideo" autoplay playsinline></video>
    </div>

    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="webrtc.js"></script> <!-- Include your WebRTC logic -->
</body>
</html>
