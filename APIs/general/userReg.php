<?php
require_once __DIR__ . "../../../config/config.php";

function validateAndSanitizeInput($email, $password) {
    $errors = [];

    // 1. Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // 2. Sanitize user input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // 3. Check for a strong password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if (!preg_match("/[A-Z]+/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }

    if (!preg_match("/[a-z]+/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    }

    if (!preg_match("/[0-9]+/", $password)) {
        $errors[] = "Password must contain at least one digit";
    }

    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];

    // Validate and sanitize input
    $errors = validateAndSanitizeInput($email, $password);

    if (empty($errors)) {
        // Hash the password (for security)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (username, password, email, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $username, $hashed_password, $email, $user_type);
            if ($stmt->execute()) {
                $_SESSION["success_msg"] = "Registration successful!";
                header("Location: success_page.php");
                exit();
            } else {
                $_SESSION["error_msg"] = "Registration failed. Please try again later.";
            }
            $stmt->close();
        } else {
            $_SESSION["error_msg"] = "Database error. Please try again later.";
        }

        // Close the database connection
        $mysqli->close();
        header("Location: register.html");
        exit();
    } else {
        echo json_encode(["errors" => $errors]);
       
    }
} else {
    // If someone tries to access this script without POST data, redirect to the registration form
    header("Location: register.html");
    exit();
}
?>
