<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(-1);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/PHPMailer-master/src/Exception.php';
    require 'phpmailer/PHPMailer-master/src/PHPMailer.php';
    require 'phpmailer/PHPMailer-master/src/SMTP.php';
    if(isset($_POST["send"])){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';//Enter your sender gmail
        $mail->Password = '';//Enter your 2-step verified app generated gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('yourMail@gmail.com');
        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);

        $mail->Subject = $_POST["subject"];

        $mail->Body = $_POST["message"];
        $mail->send();

        echo
        "
        <script>
        alert('Sent Successfully');
        document.location.href = 'notifications.php';
        </script>
        ";
    }
