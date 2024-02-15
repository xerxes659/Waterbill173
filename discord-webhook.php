<?php

// Parse meter number from request body
$meterNumber = $_POST['meter_number'];

// Set up Discord webhook
$webhookUrl = '';

// Send message to Discord webhook
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode(array(
            'content' => "Water meter number: $meterNumber"
        )),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($webhookUrl, false, $context);

if ($result === false) {
    // Error sending message to Discord
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error sending message to Discord.';
} else {
    // Message sent to Discord
    header('HTTP/1.1 200 OK');
    echo 'Message sent to Discord.';
}