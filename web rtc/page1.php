<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
</head>
<body>
    <h2>Start a Video Call</h2>
    <video id="localVideo" autoplay playsinline muted></video>
    <video id="remoteVideo" autoplay playsinline></video>

    <button id="startCall">Start Call</button>
    <button id="pickCall">Pick Call</button>

    <script>
        let localStream;
        let peerConnection;
        const config = {
            iceServers: [
                { urls: "stun:stun.l.google.com:19302" },
            ]
        };

        // Access user media (webcam)
        async function getLocalStream() {
            try {
                localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                document.getElementById('localVideo').srcObject = localStream;
            } catch (error) {
                console.error('Error accessing media devices.', error);
                alert('Could not access your camera or microphone.');
            }
        }

        // Initialize PeerConnection and add remote track handling
        function initializePeerConnection() {
            peerConnection = new RTCPeerConnection(config);

            // Handle remote stream
            peerConnection.addEventListener('track', event => {
                const [stream] = event.streams;
                document.getElementById('remoteVideo').srcObject = stream;
            });
        }

        // Create an offer to start the call
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('startCall').addEventListener('click', async () => {
                initializePeerConnection();
                localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

                try {
                    const offer = await peerConnection.createOffer();
                    await peerConnection.setLocalDescription(offer);

                    // Send offer to PHP signaling server (AJAX)
                    await fetch('signaling.php', {
                        method: 'POST',
                        body: JSON.stringify({ offer }),
                        headers: { 'Content-Type': 'application/json' }
                    });
                } catch (error) {
                    console.error('Error creating or sending offer', error);
                }
            });

            // Receive the call (Pick up the call)
            document.getElementById('pickCall').addEventListener('click', async () => {
                try {
                    const response = await fetch('signaling.php');
                    const { offer } = await response.json();

                    initializePeerConnection();
                    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

                    await peerConnection.setRemoteDescription(offer);

                    const answer = await peerConnection.createAnswer();
                    await peerConnection.setLocalDescription(answer);

                    // Send answer back to PHP signaling server (AJAX)
                    await fetch('signaling.php', {
                        method: 'POST',
                        body: JSON.stringify({ answer }),
                        headers: { 'Content-Type': 'application/json' }
                    });
                } catch (error) {
                    console.error('Error picking up the call', error);
                }
            });
        });

        // Initialize local stream on page load
        getLocalStream();
    </script>
</body>
</html>
