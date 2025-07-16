<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/Exception.php';
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';

if ($_POST) {
    $name     = htmlspecialchars($_POST['name']);
    $phone    = htmlspecialchars($_POST['phone']);
    $email    = htmlspecialchars($_POST['email']);
    $interest = htmlspecialchars($_POST['interest']);

    $mail = new PHPMailer(true);

    try {
        // SMTP server setup
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'patrasagarika654@gmail.com'; // Your Gmail
        $mail->Password   = 'ouzw ppwk ofee bpny';        // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Mail headers
        $mail->setFrom('patrasagarika654@gmail.com', 'Spider Digi Yatra');
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Quick Enquiry - Spider Digi Yatra';

        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #6366f1; }
                .value { margin-top: 5px; padding: 10px; background: white; border-radius: 5px; border-left: 4px solid #6366f1; }
                .urgent { background: #fef3c7; border-left-color: #f59e0b; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🚀 Quick Enquiry - Spider Digi Yatra</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Name:</div>
                        <div class='value'>{$name}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Phone:</div>
                        <div class='value urgent'>{$phone}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div class='value'>{$email}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Interest:</div>
                        <div class='value'>{$interest}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Submitted On:</div>
                        <div class='value'>" . date('Y-m-d H:i:s') . "</div>
                    </div>
                    <p style='background: #fee2e2; padding: 15px; border-radius: 8px; border-left: 4px solid #ef4444; margin-top: 20px;'>
                        <strong>⚡ Quick Enquiry - Please respond promptly!</strong>
                    </p>
                </div>
            </div>
        </body>
        </html>";

        $mail->send();

        echo "<script>
            window.location.href = 'index.html';
        </script>";

    } catch (Exception $e) {
        echo "<script>
            alert('Sorry, there was an error. Please try again or call us directly at +91 XXXXX XXXXX');
            window.location.href = 'index.html';
        </script>";
    }
} else {
    header('Location: index.html');
    exit();
}
?>
