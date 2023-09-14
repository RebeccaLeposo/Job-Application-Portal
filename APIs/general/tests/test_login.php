<?php
// Simulated valid login credentials
$data = [
    "username" => "valid_user",
    "password" => "StrongPassword123",
];

// Create a POST request to the login script
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/job/APIs/general/login.php"); // Replace with the actual URL
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo "cURL error: " . curl_error($ch);
} else {
    echo "Response:<br>";
    echo $response;
}

// Close the cURL resource
curl_close($ch);
