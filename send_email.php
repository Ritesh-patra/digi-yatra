<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/Exception.php';
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';

if ($_POST) {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course_interest = htmlspecialchars($_POST['course_interest']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'patrasagarika654@gmail.com'; // ✅ Tumhara Gmail
        $mail->Password = 'ouzw ppwk ofee bpny'; // 🔒 Yaha tum apna app password dalna (NOT Gmail login password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // From: Yahi email se mail jayega
        $mail->setFrom('patrasagarika654@gmail.com', 'Spider Digi Yatra');

        // To: Tumhare business/official inbox me mail milega
        // $mail->addAddress('info@spiderdigiyatra.com', 'Spider Digi Yatra');

        // Reply-To: Yeh user ka email hoga jo form me bharega
        $mail->addReplyTo($email, $first_name . ' ' . $last_name);


        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission - Spider Digi Yatra';

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
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🕷️ Spider Digi Yatra - New Contact Form Submission</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Name:</div>
                        <div class='value'>{$first_name} {$last_name}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div class='value'>{$email}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Phone:</div>
                        <div class='value'>{$phone}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Course Interest:</div>
                        <div class='value'>{$course_interest}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Message:</div>
                        <div class='value'>{$message}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Submitted On:</div>
                        <div class='value'>" . date('Y-m-d H:i:s') . "</div>
                    </div>
                </div>
            </div>
        </body>
        </html>";

        $mail->AltBody = "New Contact Form Submission\n\n" .
            "Name: {$first_name} {$last_name}\n" .
            "Email: {$email}\n" .
            "Phone: {$phone}\n" .
            "Course Interest: {$course_interest}\n" .
            "Message: {$message}\n" .
            "Submitted On: " . date('Y-m-d H:i:s');

        $mail->send();

        // Send auto-reply to user
        $autoReply = new PHPMailer(true);
        $autoReply->isSMTP();
        $autoReply->Host = 'smtp.gmail.com';
        $autoReply->SMTPAuth = true;
        $autoReply->Username = 'patrasagarika654@gmail.com';
        $autoReply->Password = 'ouzw ppwk ofee bpny';
        $autoReply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $autoReply->Port = 587;

        $autoReply->setFrom('patrasagarika654@gmail.com', 'Spider Digi Yatra');
        $autoReply->addAddress($email, $first_name . ' ' . $last_name);

        $autoReply->isHTML(true);
        $autoReply->Subject = 'Thank you for contacting Spider Digi Yatra!';

        $autoReply->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .highlight { background: #e0e7ff; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #6366f1; }
                .footer { text-align: center; margin-top: 20px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🕷️ Welcome to Spider Digi Yatra!</h2>
                </div>
                <div class='content'>
                    <p>Dear {$first_name},</p>
                    
                    <p>Thank you for your interest in Spider Digi Yatra! We have received your inquiry and our team will get back to you within 24 hours.</p>
                    
                    <div class='highlight'>
                        <h3>🎁 Don't forget about our FREE Digital Marketing Course!</h3>
                        <p>While you wait for our response, you can start with our 1-hour FREE Digital Marketing course. No cost, no commitment - just valuable knowledge!</p>
                    </div>
                    
                    <p><strong>What happens next?</strong></p>
                    <ul>
                        <li>Our counselor will contact you within 24 hours</li>
                        <li>We'll discuss your learning goals and career aspirations</li>
                        <li>Get personalized course recommendations</li>
                        <li>Learn about our internship opportunities (starting from Rs. 5,000/month)</li>
                    </ul>
                    
                    <p>If you have any urgent questions, feel free to call us at <strong>+91 XXXXX XXXXX</strong></p>
                    
                    <p>Best regards,<br>
                    <strong>Spider Digi Yatra Team</strong></p>
                    
                    <div class='footer'>
                        <p>Follow us on social media for daily tips and updates!</p>
                        <p>📧 info@spiderdigiyatra.com | 📞 +91 93</p>
                    </div>
                </div>
            </div>
        </body>
        </html>";

        $autoReply->send();

        echo "<script>
                alert('Thank you! Your message has been sent successfully. We will contact you soon.');
                window.location.href = 'index.html';
              </script>";

    } catch (Exception $e) {
        echo "<script>
                window.location.href = 'index.html';
              </script>";
    }
} else {
    header('Location: index.html');
    exit();
}
?>