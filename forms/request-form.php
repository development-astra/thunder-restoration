<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['full_name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');

    if (!$name || !$email || !$phone || !$service) {
        header("Location: http://localhost/astraresults.com/thunder-restoration/form-error.html");
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'harry@astraresults.com';
        $mail->Password   = 'pzuhhxmmirtxsjry';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // From & To
        $mail->setFrom('harry@astraresults.com', 'Thunder Restoration');
        $mail->addAddress('info@thunder-restoration.com');

        // Add CC recipients
        $mail->addCC('harry@astraresults.com');
        $mail->addCC('development@astraresults.com');
        $mail->addCC('joseph@astraresults.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Request from $name";
        $mail->Body    = "
            <h3>New Request Form Submission</h3>
            <p><strong>Full Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Service:</strong> $service</p>
        ";

        $mail->send();

        header("Location: http://localhost/astraresults.com/thunder-restoration/thank-you.html");
        exit;

    } catch (Exception $e) {
        header("Location: http://localhost/astraresults.com/thunder-restoration/form-error.html");
        exit;
    }

} else {
    header("Location: http://localhost/astraresults.com/thunder-restoration/form-error.html");
    exit;
}
