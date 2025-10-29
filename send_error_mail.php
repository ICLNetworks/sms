<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $details = trim($_POST['details'] ?? '');
    $code = trim($_POST['error_code'] ?? '');
    $msg = trim($_POST['error_msg'] ?? '');

    if ($name === '' || $email === '') {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields.']);
        exit;
    }

    $to = "jega@iclsoftwares.in";
    $subject = "Error Report [$code]";
    $body = "
        <h2>Error Report</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Error Code:</strong> $code</p>
        <p><strong>Message:</strong> $msg</p>
        <p><strong>Details:</strong><br>" . nl2br(htmlspecialchars($details)) . "</p>
    ";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: noreply@iclsoftwares.in\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully ✅']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message ❌']);
    }
    exit;
}
?>