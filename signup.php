<?php
// include 'config.php';
include 'auth.php';
$insert = new insertUser();
// Function to Form Validation
function validate($field, $fieldName)
{
    if (empty($field)) {
        return "$fieldName is Required<br>";
    }
    return "";
}

$error = "";
// It help to get the data form the Form 
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $error .= validate($name, "Name"); // it store the error mag in existing string variable
    $error .= validate($email, "Email");
    $error .= validate($password, "Password");

    if ($error == "") { // if not error then execute the success
        $success = $insert->insertUser($name, $email, $password);
        // $user = displayUsers($email);

        // if ($user) {
        //     $_SESSION['user'] =  $user['name'];
        // } else {
        //     echo "User Not Found";
        // }
    }
}


// Function To read the Data From DB
// function displayUsers($email)
// {

//     // $conn = database();
    

//     $sql = "SELECT * FROM users WHERE email = '$email' ";

//     $result = mysqli_query($this->conn, $sql);

//     if (mysqli_num_rows($result) == 0) {
//         return false;
//     } else {
//         return mysqli_fetch_assoc($result);
//     }
// }

// function updateUser($id, $name, $email) {
//     $conn = database();
//     $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
//     return mysqli_query($conn, $sql);
// }
// // $id = $_GET['id'];       // URL se ID aayegi
// $name = $_POST['name'];  // form se data
// $email = $_POST['email'];

// updateUser($conn, $id, $name, $email);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Form</title>

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
        /* 🔹 Welcome Bar */
        h2 {
            width: 100%;
            text-align: center;
            padding: 15px;
            background: linear-gradient(90deg, #00c853, #64dd17);
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        #Signup {
            margin-top: 80px;
            padding: 30px;
            width: 320px;
            border: none;
            text-align: center;
            border-radius: 15px;
            background: transparent;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
        }

        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        label {
            display: block;
            padding: 8px;
            text-align: left;
            font-size: 16px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 16px;
            border: none;
            border-bottom: 2px solid #3498db;
            outline: none;
            background: transparent;
            transition: 0.3s;
        }

        input:focus {
            border-bottom: 2px solid #2ecc71;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: linear-gradient(90deg, #3498db, #2ecc71);
            border-radius: 10px;
            border: none;
            font-size: 18px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #2ecc71, #3498db);
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 15px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- ✅ Welcome Bar -->

    <!-- <fieldset> -->

        <div id="Signup">
        <legend>Sign-up Form</legend>

        <!-- ERROR -->
        <div class="error">
            <?php echo $error ?? ""; ?>
        </div>

        <!-- SUCCESS -->
        <div class="success">
            <?php echo $success ?? ""; ?>
        </div>

        <form method="POST">
            <input type="text" name="name" value="<?php echo $_POST['name'] ?? ''; ?>" placeholder="Enter Your Name">

            <input type="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>" placeholder="Enter Your Email">

            <input type="password" name="password" placeholder="Enter Your Password">

            <button type="submit" name="submit">Sign-up</button>
        </form>
    </div>

</body>
</html>