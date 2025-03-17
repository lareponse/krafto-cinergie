<?php

/**
 * Weekly Agenda Sanitize Cron Script
 * 
 * Makes an HTTP request to the agenda sanitization endpoint
 * Run this script weekly via cron
 * Keeps only the last 100 log entries
 */

// Log file path
$logFile = __DIR__ . '/agenda_sanitize_log.txt';

// URL to request
$url = 'https://cinergie.be/dash/Sanitize/Agenda';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, 'Cinergie-AgendaSanitizeCron/1.0');

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

// Close cURL session
curl_close($ch);

// Log results
$timestamp = date('Y-m-d H:i:s');
$logMessage = "$timestamp - HTTP Status: $httpCode";

if ($error) {
    $logMessage .= " - Error: $error";
}

if ($httpCode >= 200 && $httpCode < 300) {
    $logMessage .= " - Success: Agenda sanitize request completed";
} else {
    $logMessage .= " - Failed: Request unsuccessful";
}

// Read existing log file
$existingLog = [];
if (file_exists($logFile)) {
    $existingLog = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Add new log entry
$existingLog[] = $logMessage;

// Keep only the last 100 entries
if (count($existingLog) > 100) {
    $existingLog = array_slice($existingLog, -100);
}

// Write updated log back to file
file_put_contents($logFile, implode(PHP_EOL, $existingLog));

// Output to console when run manually
echo $logMessage . PHP_EOL;
