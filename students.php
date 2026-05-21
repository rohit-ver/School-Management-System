<?php
require_once 'model/stu_model.php';
$title = "Students Management";
require_once "layout.php";
$student = new Student();
$students = $student->getStu();

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $result = $student->deleteStu($id);

    if($result == 'deleted'){
        header('Location: students.php');
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
        .btn {
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
    <h2>Students List</h2>
    <link rel="stylesheet" href="css/style.css">


    <a href="Add-edit_student.php" class="btn add">+ Add Student</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Action</th>
        </tr>

        <?php foreach ($students as $stu) { ?>
        <tr>
                <td><?= $stu['id'] ?></td>
                <td><?= $stu['name'] ?></td>
                <td><?= $stu['cource'] ?></td>
                <td>
                    <a href="Add-edit_student.php?edit=<?= $stu['id'] ?>" class="btn edit">Edit</a>
                    <a href="students.php?delete=<?= $stu['id'] ?>" onclick="return confirm('Are you sure?')" class="btn delete">Delete</a> 
                    <a href="#" onclick="openModal('<?= $stu['name'] ?>','<?= $stu['email'] ?>','<?= $stu['mobile'] ?>','<?= $stu['cource'] ?>', '<?= $stu['fees'] ?>' , '<?= $stu['address'] ?>'); return false;" class="btn view">View</a>

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
                <p id="name"><?= $stu['name'] ?></p>
            </div>

            <div class="detail-row">
                <span>Email:</span>
                <p id="email"><?= $stu['email'] ?></p>
            </div>

            <div class="detail-row">
                <span>Mobile:</span>
                <p id="mobile"><?= $stu['mobile'] ?></p>
            </div>

            <div class="detail-row">
                <span>Cource:</span>
                <p id="cource"><?= $stu['cource'] ?></p>
            </div>

            <div class="detail-row">
                <span>Fees:</span>
                <p id="cource"><?= $stu['fees'] ?></p>
            </div>

            <div class="detail-row">
                <span>Address:</span>
                <p id="cource"><?= $stu['address'] ?></p>
            </div>

        </div>

    </div>

    <script>
        // Open Modal
        function openModal(name, email, mobile, cource,className) {

            document.getElementById("viewModal").style.display = "block";

            document.getElementById("name").innerText = name;
            document.getElementById("email").innerText = email;
            document.getElementById("mobile").innerText = mobile;
            document.getElementById("cource").innerText = cource;
            document.getElementById("fees").innerText = fees;
            document.getElementById("address").innerText = address;
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