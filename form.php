<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $phone    = $_POST['phonenumber'] ?? '';
    $date     = $_POST['date'] ?? '';
    $time     = $_POST['time'] ?? '';
    $service  = $_POST['service'] ?? '';
    $note     = $_POST['note'] ?? '';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'selmansiraj7@gmail.com'; // your Gmail
        $mail->Password   = 'tgxv sjrl npzi flww';   // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('selmansiraj7@gmail.com', 'Aleef Dental Clinic');
        $mail->addAddress('selmansiraj7@gmail.com'); // where the form should go
        $mail->addReplyTo($email, $fullname);

        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Request';
        $mail->Body = "
            <b>Full Name:</b> $fullname<br>
            <b>Email:</b> $email<br>
            <b>Phone:</b> $phone<br>
            <b>Date:</b> $date<br>
            <b>Time:</b> $time<br>
            <b>Service:</b> $service<br>
            <b>Notes:</b> $note<br>
        ";

        $mail->send();
        echo "✅ Booking request sent successfully!";
    } catch (Exception $e) {
        echo "❌ Error: " . $mail->ErrorInfo;
    }
}
?>
