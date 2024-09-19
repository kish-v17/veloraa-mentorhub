<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Jitsi Integration</title>
    <style>
        /* Your custom styles here */
        #jitsi-container {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Welcome to My Custom Video Chat</h1>
    <div id="jitsi-container"></div>
    <button id="startCallButton">Start Call</button>

    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        document.getElementById('startCallButton').addEventListener('click', function() {
            const domain = 'meet.jit.si';
            const options = {
                roomName: 'name',
                width: '100%',
                height: 500,
                parentNode: document.querySelector('#jitsi-container'),
                configOverwrite: {
                    startWithVideoMuted: false,
                    startWithAudioMuted: false
                },
                interfaceConfigOverwrite: {
                    filmStripOnly: false
                }
            };
            const api = new JitsiMeetExternalAPI(domain, options);

            api.addEventListener('videoConferenceJoined', () => {
                console.log('Video conference joined');
            });
        });
    </script>
</body>
</html>
