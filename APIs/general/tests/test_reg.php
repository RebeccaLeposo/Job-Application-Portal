<?php
// Simulated invalid input data
$data = [
    "username" => "valid_user",          // Valid username
    "password" => "StrongPassword123",   // Strong password
    "email" => "user@example.com",       // Valid email format
    "user_type" => "Job Seeker",         // Valid user type
];

// Create a POST request to the registration script
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/job/APIs/general/userReg.php"); // Replace with the actual URL
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
