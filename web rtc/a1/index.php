<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebRTC Video Call</title>
    <style>
        video {
            width: 45%;
            height: auto;
            display: inline-block;
        }
        #controls {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>WebRTC Video Call</h1>

    <div id="controls">
        <input type="text" id="codeInput" placeholder="Enter code here" />
        <button id="startButton">Start Call</button>
        <button id="joinButton">Join Call</button>
    </div>

    <video id="localVideo" autoplay muted></video>
    <video id="remoteVideo" autoplay></video>

    <script src="client.js"></script>
</body>
</html>
