<?php
session_start();
include 'config/config.php';
// include 'signup.php';

// Fuction To Insert Data in DB 
class insertUser extends Database
{
    function insertUser($name, $email, $password)
    {

        // $conn = database();

        // It Check the user email is Exist or not 
        $check = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($check);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Email Already Exists";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data USing Prepare statement
        $sql = "INSERT INTO users(name, email, password) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $name, $email, $hashedPassword);


        if (($stmt->execute())) {
            return header("location: login.php");
        } else {
            return "Error: Please Try Again!";
        }
    }


    function userLogin($email, $password, $remember = false)
    {
        // $conn = database();

        $sql = "SELECT * FROM users WHERE email = '$email' ";
        $result = mysqli_query($this->conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $row['password'])) {

                $_SESSION['user'] = $row['name'];

                if ($remember) {
                    setcookie('user_email', $row['email'], time() + (86400 * 7), "/");
                }
                return true;
            }
        }
        return false;
    }
}


// To check Auto login
function autoLogin()
{
    if (!isset($_SESSION['user']) && isset($_COOKIE['user_email'])) {
        $_SESSION['user'] = $_COOKIE['user_email'];
    }
}
