<?php 
include_once("dbfunction.php");

// if ($_SERVER['REQUEST_METHOD'] === "POST") {
// 	$student_name = $_POST['student_name'];
// 	$student_card = $_POST['student_card'];

// 	$qry = $this->conn->prepare("SELECT `student_id` FROM `ws_students` WHERE `student_name` = ? AND `card_number` = ?");
// 	$qry -> bind_param("ss",$student_name,$student_card);
// 	$qry -> execute();
// 	$result = $qry -> get_result();
// 		if ($result->num_rows == 0) {
// 			# code...
// 			$insert_qry = $this->conn->prepare("INSERT INTO `ws_students`(`student_name`,`card_number`) VALUES (?,?)");
// 			$insert_qry -> bind_param("ss",$student_name,$student_card);
// 			$insert_qry -> execute();
// 				if ($insert_qry) {
// 					# code...
// 					header("location:index.php");
// 					exit();
// 				}
// 		}
// }

	$qry = new db;

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		# code...
		$student_name = $_POST['student_name'];
		$student_card = $_POST['student_card'];
		$data = $qry -> admin($student_name,$student_card);
			if ($data) {
				header("location:index.php");
				exit();
			}

	}

?>