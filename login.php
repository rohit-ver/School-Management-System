<?php
include 'auth.php';
$loguser = new insertUser();

autoLogin();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    if ($loguser->userLogin($email, $password, $remember)) {
        header("location: layout.php");
    } else
        echo "invalid Credintial";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        form {
            background: transparent;
            padding: 30px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Input Fields */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-bottom: 2px solid #3498db;
            outline: none;
            background: transparent;
            transition: 0.3s;
        }

        /* Input Focus Effect */
        input:focus {
            border-bottom: 2px solid #2ecc71;

        }

        /* Checkbox */
        label {
            font-size: 14px;
            color: #555;
        }

        /* Button */
        button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Button Hover */
        button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #9face6, #74ebd5);

        }
    </style>
</head>

<body>


    <form method="POST">
        <h2>Login</h2>
        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>
        <input type="email" name="email" placeholder="Enter Email" required><br><br>

        <input type="password" name="password" placeholder="Enter Password" required><br><br>

        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label><br><br>

        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>