<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_POST) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $interest = htmlspecialchars($_POST['interest']);
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@gmail.com';
        $mail->Password   = 'your-app-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Spider Digi Yatra');
        $mail->addAddress('info@spiderdigiyatra.com', 'Spider Digi Yatra');
        $mail->addReplyTo($email, $name);
        
        // Content
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
        
        // Send auto-reply
        $autoReply = new PHPMailer(true);
        $autoReply->isSMTP();
        $autoReply->Host       = 'smtp.gmail.com';
        $autoReply->SMTPAuth   = true;
        $autoReply->Username   = 'your-email@gmail.com';
        $autoReply->Password   = 'your-app-password';
        $autoReply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $autoReply->Port       = 587;
        
        $autoReply->setFrom('your-email@gmail.com', 'Spider Digi Yatra');
        $autoReply->addAddress($email, $name);
        
        $autoReply->isHTML(true);
        $autoReply->Subject = 'We received your enquiry - Spider Digi Yatra';
        
        $autoReply->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 0 0 10px 10px; }
                .highlight { background: #e0e7ff; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #6366f1; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🕷️ Thank You for Your Enquiry!</h2>
                </div>
                <div class='content'>
                    <p>Hi {$name},</p>
                    
                    <p>Thank you for your quick enquiry! We're excited about your interest in our programs.</p>
                    
                    <div class='highlight'>
                        <h3>⚡ Quick Response Promise</h3>
                        <p>Our team will contact you within <strong>2 hours</strong> to discuss your requirements and answer all your questions.</p>
                    </div>
                    
                    <p><strong>In the meantime:</strong></p>
                    <ul>
                        <li>🎁 Check out our FREE Digital Marketing course</li>
                        <li>💼 Learn about internship opportunities (Rs. 5,000+/month)</li>
                        <li>📱 Follow us on social media for tips and updates</li>
                    </ul>
                    
                    <p>For immediate assistance, call: <strong>+91 XXXXX XXXXX</strong></p>
                    
                    <p>Best regards,<br>
                    <strong>Spider Digi Yatra Team</strong></p>
                </div>
            </div>
        </body>
        </html>";
        
        $autoReply->send();
        
        echo "<script>
                alert('Thank you! We have received your enquiry. Our team will contact you within 2 hours.');
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
