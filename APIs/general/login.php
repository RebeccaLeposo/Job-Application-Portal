<?php
session_start();
require_once __DIR__ . "../../../config/config.php"; // Replace with the actual path

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate and sanitize input (you can reuse the validateAndSanitizeInput function)
    $errors = validateAndSanitizeInput($username, $password);

    if (empty($errors)) {
        // Check if the user exists in the database
        $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($user_id, $db_username, $db_password);
                $stmt->fetch();

                // Verify the password
                if (password_verify($password, $db_password)) {
                    // Password is correct, set session variables and redirect to a logged-in page
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["username"] = $db_username;
                    header("Location: logged_in.php"); // Replace with your logged-in page
                    exit();
                } else {
                    $errors[] = "Invalid password";
                }
            } else {
                $errors[] = "User not found";
            }

            $stmt->close();
        } else {
            $_SESSION["error_msg"] = "Database error. Please try again later.";
        }
    }

    // If there are errors, store them in the session and redirect back to the login page
    $_SESSION["login_errors"] = $errors;
    
    //header("Location: login.php"); // Replace with your login page ToDo
    exit();
} else {
    // If someone tries to access this script without POST data, redirect to the login page
    // header("Location: login.php"); // Replace with your login page
    exit();
}
?>
