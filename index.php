<?php
session_start();
include_once("dbfunction.php");
$qry = new db;
date_default_timezone_set('Asia/Kuala_Lumpur');
$c_date = (new DateTime())->format('Y-m-d');
$date_qry = $qry->query("SELECT * FROM `ws_attendance` AS a INNER JOIN `ws_students` AS s ON a.student_id = s.student_id WHERE a.date = '$c_date'");
$alertMessage = $alertType = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['id'])) {
        $card_number = $_POST['id'];
        if (isset($_SESSION['last_scan_time']) && time() - strtotime($_SESSION['last_scan_time']) < 5 * 60) {
            $alertMessage = "Please wait for " . (5 * 60 - (time() - strtotime($_SESSION['last_scan_time']))) . " seconds before scanning again.";
            $alertType = "danger";
        } elseif ($qry->login($card_number)) {
            $alertMessage = "Successfully recorded attendance.";
            $alertType = "success";
            $_SESSION['last_scan_time'] = date("Y-m-d H:i:s");
        } else {
            $alertMessage = "Failed to record attendance. Invalid card number or incorrect time.";
            $alertType = "danger";
        }
    }
    if (isset($_POST['attendance_date'])) {
        $date_qry = $qry->fetch($_POST['attendance_date']);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>#timer {font-size: 150px; text-align: center; margin: 50px 0;}</style>
</head>
<body>
    <div class="container mt-5">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button" role="tab" aria-controls="admin-tab-pane" aria-selected="false">Admin</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div align="center">
                    <form method="post" action="index.php">
                        <input type="text" name="id" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 13" autocomplete="off" style="font-size: 40px;" autofocus="on">
                        <input type="submit" name="submit" value="Submit" style="font-size: 40px; margin-top: 50px;">
                        <h1 id="timer"></h1>
                    </form>
                    <?php if (!empty($alertMessage)) { ?>
                        <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
                            <?= $alertMessage ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <form method="post" action="index.php">
                    <input type="date" name="attendance_date" value="<?= $c_date; ?>">
                    <input type="submit" name="submit" value="Submit">
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Date</th>
                            <th>8am Check-in</th>
                            <th>12pm Check-out</th>
                            <th>1pm Check-in</th>
                            <th>5pm Check-out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rows = $date_qry->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $rows['student_name'] ?></td>
                                <td><?= $rows['date'] ?></td>
                                <td><?= $rows['8am_checkin'] ?></td>
                                <td><?= $rows['12pm_checkout'] ?></td>
                                <td><?= $rows['1pm_checkin'] ?></td>
                                <td><?= $rows['5pm_checkout'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="admin-tab-pane" role="tabpanel" aria-labelledby="admin-tab" tabindex="0">
                <div class="container">
                    <h3 class="mb-4">Add New Student Card</h3>
                    <form method="post" action="admin_process.php" class="mb-5">
                        <div class="form-group">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="student_name" placeholder="Enter student name" required>
                        </div>
                        <div class="form-group">
                            <label for="studentCard">Card Number</label>
                            <input type="text" class="form-control" id="studentCard" name="student_card" placeholder="Enter card number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </form>

                    <h3>List of Students</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Card Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $students = $qry->query("SELECT * FROM ws_students");
                            while ($student = $students->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $student['student_name'] ?></td>
                                    <td><?= $student['card_number'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateTimer() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('timer').innerText = hours + ':' + minutes + ':' + seconds;
        }
        setInterval(updateTimer, 1000);
    </script>
</body>
</html>
