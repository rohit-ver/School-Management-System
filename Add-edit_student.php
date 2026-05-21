<?php
// include 'config/config.php';
include 'model/stu_model.php';

$student = new Student();

$editstu = [];

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $check = "SELECT * FROM students WHERE id = ?";
    $stmt = $student->conn->prepare($check);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $editstu = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $cource = $_POST['cource'];
    $fees = $_POST['fees'];
    $address = $_POST['address'];


    $data = [
        'name' => $name,
        'email' => $email,
        'mobile' => $mobile,
        'cource' => $cource,
        'fees' => $fees,
        'address' => $address
    ];

    $student->insertStu($data);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <form method="POST">

        <h2>Add Student</h2>
        <input type="hidden" name="id" value="<?= $editstu['id'] ?? '' ?>" required>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= $editstu['name'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $editstu['email'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" value="<?= $editstu['mobile'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Cource</label>
            <input type="text" name="cource" value="<?= $editstu['cource'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Fees</label>
            <input type="number" name="fees" value="<?= $editstu['fees'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="<?= $editstu['address'] ?? '' ?>" required>
        </div>

        <button type="submit" name="submit"><?= isset($editstu['id']) ? 'Update' : 'Add' ?></button>
    </form>
</body>

</html>