<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Sanitize & prepare inputs
    $code = trim($_POST['code'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $description = trim($_POST['description'] ?? '');
    $msg = trim($_POST['msg'] ?? '');

    // Build subject with separator
    $subject = trim($code . ' - ' . $title);

    // Basic validation
    if ($subject === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please provide a valid email and subject.']);
        exit;
    }

    // Recipient & mail body
    $to = "admin@iclsoftwares.in";
    $subject = "Error Report [$subject]";
    $body = "
        <h2>Error Report</h2>
        <p><strong>Error Code:</strong> " . htmlspecialchars($code) . "</p>
        <p><strong>Title:</strong> " . htmlspecialchars($title) . "</p>
        <p><strong>Description:</strong><br>" . nl2br(htmlspecialchars($description)) . "</p>
        <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($msg)) . "</p>
        <p><strong>From:</strong> " . htmlspecialchars($email) . "</p>
    ";

    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: noreply@iclsoftwares.in\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send mail
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully ✅']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message ❌']);
    }
    exit;
}
?>
