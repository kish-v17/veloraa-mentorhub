<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jitsi Meet with JaaS</title>
    <style>
        #jitsi-container {
            width: 100%;
            height: 600px;
        }
    </style>
</head>
<body>

    <h1>Start Video Conference</h1>
    <div id="jitsi-container"></div>
    
    <!-- Jitsi Meet External API -->
    <script src="https://8x8.vc/external_api.js"></script>

    <script>
        // Replace these with your Jitsi-as-a-Service (JaaS) credentials
        const apiKey = 'YOUR_API_KEY';
        const appId = 'vpaas-magic-cookie-c918511a2d644e5fbffbfdddd32db047';
        const tenant = 'YOUR_TENANT_NAME';  // Provided in your JaaS dashboard
        
        // Create the Jitsi Meet API object
        const domain = '8x8.vc';
        const options = {
            roomName: 'MyCustomRoom', // Customize room names dynamically
            parentNode: document.querySelector('#jitsi-container'),
            configOverwrite: {
                startWithVideoMuted: false,
                startWithAudioMuted: false
            },
            interfaceConfigOverwrite: {
                filmStripOnly: false,
            },
            jwt: 'YOUR_GENERATED_JWT', // If required for your service
        };

        const api = new JitsiMeetExternalAPI(domain, options);
    </script>

</body>
</html>
