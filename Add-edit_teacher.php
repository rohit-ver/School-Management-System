<?php
include 'model/Tea_model.php';

$teacher = new Teacher();
$editData = [];

// 🔹 EDIT MODE (GET request)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $sql = "SELECT * FROM teachers WHERE id = ?";
    $stmt = $teacher->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $editData = $result->fetch_assoc();
}

// 🔹 FORM SUBMIT (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'mobile' => $_POST['mobile'],
        'subject' => $_POST['subject'],
        'experience' => $_POST['experience'],
        'salary' => $_POST['salary'],
        'joining_date' => $_POST['joining_date']
    ];

    $id = $_POST['id'];

    if (!empty($id)) {
        $result = $teacher->updateTeacher($id, $data);
    } else {
        $result = $teacher->insertTeacher($data);
    }

    // 🔥 redirect (important)
    header("Location: teachers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <form method="POST">
        <h2>Add Teacher</h2>

        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">


        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= $editData['name'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $editData['email'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" value="<?= $editData['mobile'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" value="<?= $editData['subject'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Experience (Years)</label>
            <input type="number" name="experience" value="<?= $editData['experience'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Salary</label>
            <input type="number" name="salary" value="<?= $editData['salary'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Joining Date</label>
            <input type="date" name="joining_date" value="<?= $editData['joining_date'] ?? '' ?>">
        </div>

        <button type="submit" name="submit"> <?= isset($editData) ? 'Update' : 'Add' ?></button>
    </form>
</body>

</html>