<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "Auther";

    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {
            die("Connection Failed");
        }
    }
}

// This function is used to create a email or to send 
// function sendMail($to, $subject, $body) {

    // $mail = new PHPMailer(true);

//     try {
//         // SMTP settings
//         $mail->isSMTP();
//         $mail->Host       = 'smtp.gmail.com';
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'your_email@gmail.com';
//         $mail->Password   = 'your_app_password'; // 🔥 Gmail App Password Setup
//         $mail->SMTPSecure = 'tls';
//         $mail->Port       = 587;

//         // Sender & Receiver
//         $mail->setFrom('your_email@gmail.com', 'Your App');
//         $mail->addAddress($to);

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body    = $body;

//         $mail->send();
//         return true;

//     } catch (Exception $e) {
//         return false;
//     }
// }
