<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email address to send the form data to
    $to = "waqarhussain92670@gmail.com"; // Replace with your email address
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/html\r\n";

    // Subject and body of the email
    $email_subject = "Contact Form Submission: " . $subject;
    $email_body = "<h2>Contact Form Submission</h2>";
    $email_body .= "<p><strong>Name:</strong> {$name}</p>";
    $email_body .= "<p><strong>Email:</strong> {$email}</p>";
    $email_body .= "<p><strong>Subject:</strong> {$subject}</p>";
    $email_body .= "<p><strong>Message:</strong></p>";
    $email_body .= "<p>{$message}</p>";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo '{
            "status": "success",
            "message": "Your message has been sent. Thank you!"
        }';
    } else {
        echo '{
            "status": "error",
            "message": "There was an error sending your message. Please try again later."
        }';
    }
} else {
    echo '{
        "status": "error",
        "message": "Invalid request."
    }';
}
?>
