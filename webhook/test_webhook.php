<?php
$webhookData = file_get_contents('php://input');
$data = json_decode($webhookData, true); 

// save all webhooks posts
$file = 'eb_webhook_logs.txt';
file_put_contents($file, $webhookData.PHP_EOL, FILE_APPEND);

// Process the webhook data

?>