let localStream;
let remoteStream;
let peerConnection;
const servers = {
    iceServers: [
        {
            urls: 'stun:stun.l.google.com:19302' // STUN server
        }
    ]
};

// Get video elements
const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');

// Handle the "Start Call" button click
async function startCall(userId) {
    await setupLocalStream();
    sendSignalToServer('call_user', userId); // Example signaling function
}

// Set up the local video stream
async function setupLocalStream() {
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    localVideo.srcObject = localStream;

    createPeerConnection();
}

// Create the WebRTC peer connection
function createPeerConnection() {
    peerConnection = new RTCPeerConnection(servers);

    // Add local stream tracks to the peer connection
    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

    // When a remote track is received, add it to the remote video element
    peerConnection.ontrack = event => {
        remoteStream = event.streams[0];
        remoteVideo.srcObject = remoteStream;
    };

    // Handle ICE candidates
    peerConnection.onicecandidate = event => {
        if (event.candidate) {
            sendSignalToServer('ice_candidate', event.candidate);
        }
    };
}

// Function to send signals to the server
function sendSignalToServer(type, data) {
    // WebSocket logic to send data to the server
    // Example: socket.emit(type, data);
}

// Handle incoming call offer
async function handleCallOffer(offer, callerId) {
    const acceptCall = confirm(`Incoming call from user ${callerId}. Do you want to accept it?`);

    if (acceptCall) {
        // Set up the local stream
        await setupLocalStream();

        // Set the remote offer as the peer connection's remote description
        peerConnection.setRemoteDescription(new RTCSessionDescription(offer));

        // Create an answer
        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);

        // Send the answer back to the caller
        sendSignalToServer('answer', { answer, callerId });
    } else {
        // Reject the call (optional logic to handle call rejection)
        console.log("Call rejected.");
    }
}

// Handle incoming answer (if you initiated the call)
async function handleAnswer(answer) {
    peerConnection.setRemoteDescription(new RTCSessionDescription(answer));
}

// Handle incoming ICE candidates
function handleICECandidate(candidate) {
    peerConnection.addIceCandidate(new RTCIceCandidate(candidate));
}

// Listen for incoming WebSocket signals (WebSocket setup assumed)
socket.on('call_offer', (data) => {
    handleCallOffer(data.offer, data.callerId); // When you receive a call offer
});

socket.on('answer', (data) => {
    handleAnswer(data.answer); // When the called user accepts the call
});

socket.on('ice_candidate', (data) => {
    handleICECandidate(data.candidate); // When receiving ICE candidates
});
