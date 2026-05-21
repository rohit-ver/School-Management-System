<?php
session_start();
include 'model/count_model.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['user'];

$count = new Count();
$totalTeacher = $count->getTeacherCount();
$totalstu = $count->getStuCount();
$sumFees = $count->getTotalFee();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Dashboard Boxes */
        .dashboard-boxes {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .box {
            flex: 1;
            min-width: 200px;
            background: rgba(255, 255, 255, 0.12);
            padding: 20px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: 0.3s;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box h4 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #ddd;
        }

        .box p {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>SMS</h2>
        <a href="layout.php">Dashboard</a>
        <a href="students.php">Students</a>
        <a href="teachers.php">Teachers</a>
        <a href="fees.php">Fees</a>
    </div>

    <div class="main">
        <div class="navbar">
            <h3><?= $title ?? 'Page'; ?></h3>
            <div>
                Welcome <?= htmlspecialchars($user); ?>
                <a href="logout.php" style="color:red;">Logout</a>
            </div>
        </div>
        <div class="dashboard-boxes">

            <div class="box">
                <h4>Total Students</h4>
                <p><?= $totalstu ?? 0 ?></p>
            </div>

            <div class="box">
                <h4>Total Teachers</h4>
                <p><?= $totalTeacher ?? 0 ?></p>
            </div>

            <div class="box">
                <h4>Total Fees</h4>
                <p>₹ <?= $sumFees ?? 0 ?></p>
            </div>

        </div>