<?php
$title = "Teachers Management";
include "layout.php";
require_once 'model/Tea_model.php';
$teacher = new Teacher();

$teachers = $teacher->getTeacher();

 if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $result = $teacher->deleteTeacher($id);

    if($result == 'deleted'){
        header('Location: teachers.php');
    }
    else{
        echo 'Not delete';
    }

 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard'; ?></title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <style>
        /* Modal Background */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        /* Modal Box */
        .modal-content {
            background: rgba(255, 255, 255, 0.15);
            margin: 8% auto;
            padding: 20px;
            width: 400px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            color: white;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Close Button */
        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
        }

        /* Detail Row */
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        /* Button */
        .btn.view {
            padding: 8px 15px;
            background: #17a2b8;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h2>Teachers List</h2>

    <a href="Add-edit_teacher.php" class="btn add">+ Add Teacher</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Action</th>
        </tr>

        <?php foreach ($teachers as $row) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['subject']; ?></td>
                <td>
                    <a href="Add-edit_teacher.php?edit=<?= $row['id'] ?>" class="btn edit">Edit</a>
                    <a href="teachers.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn delete">Delete</a>
                    <a href="#" onclick="openModal('<?= $row['name'] ?>','<?= $row['email'] ?>','<?= $row['mobile'] ?>','<?= $row['subject'] ?>','<?= $row['experience'] ?>','<?= $row['salary'] ?>','<?= $row['joining_date'] ?>'); return false;" class="btn view">View</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    </div>

    <!-- 🔥 Modal -->
    <div id="viewModal" class="modal">

        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <h2>Student Details</h2>

            <div class="detail-row">
                <span>Name:</span>
                <p id="name"><?= $row['name']; ?></p>
            </div>

            <div class="detail-row">
                <span>Email:</span>
                <p id="email"><?= $row['email']; ?></p>
            </div>

            <div class="detail-row">
                <span>Mobile:</span>
                <p id="mobile"><?= $row['mobile']; ?></p>
            </div>

            <div class="detail-row">
                <span>Subject:</span>
                <p id="subject"><?= $row['subject']; ?></p>
            </div>

            <div class="detail-row">
                <span>Class:</span>
                <p id="class"><?= $row['name']; ?></p>
            </div>

            <div class="detail-row">
                <span>Experience:</span>
                <p id="experience"><?= $row['experience']; ?></p>
            </div>

            <div class="detail-row">
                <span>Salary:</span>
                <p id="salary"><?= $row['salary']; ?></p>
            </div>

            <div class="detail-row">
                <span>Joining-date:</span>
                <p id="joining_date"><?= $row['joining_date']; ?></p>
            </div>

        </div>

    </div>

    <script>
        // Open Modal
        function openModal(name, email, mobile, subject, experience, salary, joining_date) {

            document.getElementById("viewModal").style.display = "block";

            document.getElementById("name").innerText = name;
            document.getElementById("email").innerText = email;
            document.getElementById("mobile").innerText = mobile;
            document.getElementById("subject").innerText = subject;
            document.getElementById("experience").innerText = experience;
            document.getElementById("salary").innerText = salary;
            document.getElementById("joining_date").innerText = joining_date;
        }

        // Close Modal
        function closeModal() {
            document.getElementById("viewModal").style.display = "none";
        }

        // 🔥 Click outside to close (PRO FEATURE)
        window.onclick = function(event) {
            let modal = document.getElementById("viewModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>