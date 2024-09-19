document.addEventListener("DOMContentLoaded", function() {
    const localVideo = document.getElementById('localVideo');
    const remoteVideo = document.getElementById('remoteVideo');
    const codeInput = document.getElementById('codeInput');
    const startButton = document.getElementById('startButton');
    const joinButton = document.getElementById('joinButton');

    let localStream;
    let peerConnection;
    let uniqueCode = '';

    const configuration = { 
        iceServers: [{ urls: 'stun:stun.l.google.com:19302' }]
    };

    async function startCall() {
        uniqueCode = generateUniqueCode();
        codeInput.value = uniqueCode;

        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;

        peerConnection = new RTCPeerConnection(configuration);
        localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

        peerConnection.onicecandidate = event => {
            if (event.candidate) {
                sendToServer({ 'candidate': event.candidate });
            }
        };

        peerConnection.ontrack = event => {
            remoteVideo.srcObject = event.streams[0];
        };

        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        sendToServer({ 'sdp': peerConnection.localDescription });
    }

    async function joinCall() {
        uniqueCode = codeInput.value;
        await handleRemoteSDP();
    }

    async function handleRemoteSDP() {
        const response = await fetch('signaling.php?code=' + uniqueCode);
        const data = await response.json();
        if (data.sdp) {
            await peerConnection.setRemoteDescription(new RTCSessionDescription(data.sdp));
            if (data.sdp.type === 'offer') {
                const answer = await peerConnection.createAnswer();
                await peerConnection.setLocalDescription(answer);
                sendToServer({ 'sdp': peerConnection.localDescription });
            }
        }
        if (data.candidate) {
            await peerConnection.addIceCandidate(new RTCIceCandidate(data.candidate));
        }
    }

    function sendToServer(data) {
        fetch('signaling.php?code=' + uniqueCode, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'Content-Type': 'application/json' }
        });
    }

    function generateUniqueCode() {
        return Math.random().toString(36).substring(2, 8);
    }

    startButton.addEventListener('click', startCall);
    joinButton.addEventListener('click', joinCall);

    // Poll the server for signaling data
    const eventSource = new EventSource('signaling.php?code=' + uniqueCode);
    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        if (data.sdp || data.candidate) {
            handleRemoteSDP();
        }
    };
});
