<?php
    include_once("dbfunction.php");

	$db_qry = null;
	$date = new DateTime();


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $date = $_POST['attendance_date'];
        $qry = new db;
        $db_qry = $qry->fetch($date);
    }
    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Record</title>
</head>
<body>
    <ul class="nav nav-item mb-3">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Time</a>
        </li>
        <li class="nav-underline">
            <a class="nav-link  active" href="student_list.php">Record</a>
        </li>
    </ul>

    <form method="POST" action="student_list.php">
        <label for="attendance_date">Select Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" required>
        <button type="submit">Check Attendance</button>
    </form>

    <table class="table table-hover">
        <tr>
            <th>No.</th>
            <th>Student</th>
            <th>Check_in 8.00a.m.</th>
            <th>Check_out 12.00a.m.</th>
            <th>Check_in 1.00p.m.</th>
            <th>Check_out 5.00p.m.</th>
        </tr>
        <?php if ($db_qry) { ?>
        <?php while ($row = $db_qry->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['8am_checkin'] ?></td>
            <td><?= $row['12am_checkout'] ?></td>
            <td><?= $row['1pm_checkin'] ?></td>
            <td><?= $row['5pm_checkout'] ?></td>
        </tr>
        <?php } ?>
    <?php }else{ ?>
    	<tr>
            <td colspan="6" style="text-align: center;"><b ><i>No records</i></b></td>
        </tr>
    <?php } ?>
    </table>

</body>
</html>
