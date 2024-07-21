<?php
header("Content-Type: application/json");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit();
    }

    $data = [
        "name" => $name,
        "email" => $email,
        "subject" => $subject,
        "message" => $message,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    $jsonData = json_encode($data) . PHP_EOL;

    if (file_put_contents("messages.txt", $jsonData, FILE_APPEND)) {
        echo json_encode(["status" => "success", "message" => "Your message has been sent. Thank you!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save your message. Please try again."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
