<?php 
// include_once("db.php");

// class db extends Database {
    
//     public function __construct() {
//         $this->dbconnect();
//     }

//     function query($qry){
//         $qry = $this->conn->query($qry);

//         return $qry;
//     }

//     public function login($card_number) {
//     // Set the timezone to Asia/Kuala Lumpur
//     date_default_timezone_set('Asia/Kuala_Lumpur');

//     $query = $this->conn->prepare("SELECT `student_id` FROM `ws_students` WHERE `card_number` = ?");
//     $query->bind_param("s", $card_number);
//     $query->execute();
//     $result = $query->get_result();
//     $row = $result->fetch_assoc();

//     if ($result->num_rows == 1) {
//         $student_id = $row['student_id'];
//         $current_time = new DateTime();
//         $current_time_str = $current_time->format('H:i:s'); // Current time as string

//         // Define the time intervals for checking in and out
//         $Time1 = new DateTime("08:00:00");
//         $Time2 = new DateTime("12:00:00");
//         $Time3 = new DateTime("13:00:00");
//         $Time4 = new DateTime("17:00:00");

//         $qry = $this->conn->prepare("SELECT * FROM `ws_attendance` WHERE `student_id` = ?");
//         $qry->bind_param("i", $student_id);
//         $qry->execute();
//         $result = $qry->get_result();

//         if ($result->num_rows == 0) {
//             // Insert a new row for the student if not exists
//             $in_query = $this->conn->prepare("INSERT INTO `ws_attendance` (`student_id`) VALUES (?)");
//             $in_query->bind_param("i", $student_id);
//             if ($in_query->execute()) {
//                 // Check-in and check-out logic
//                 if ($Time1 <= $current_time && $current_time < $Time2) {
//                     $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `8am_checkin` = ? WHERE `student_id` = ?");
//                     $update_query->bind_param("si", $current_time_str, $student_id);
//                     if ($update_query->execute() && $update_query->affected_rows > 0) {
//                         return "8 AM check-in recorded for student ID: " . $student_id;
//                     } else {
//                         return "8 AM check-in already recorded or failed to update.";
//                     }
//                 } elseif ($Time2 <= $current_time && $current_time < $Time3) {
//                     $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `12pm_checkout` = ? WHERE `student_id` = ?");
//                     $update_query->bind_param("si", $current_time_str, $student_id);
//                     if ($update_query->execute() && $update_query->affected_rows > 0) {
//                         return "12 PM checkout recorded for student ID: " . $student_id;
//                     } else {
//                         return "12 PM checkout already recorded or failed to update.";
//                     }
//                 } elseif ($Time3 <= $current_time && $current_time < $Time4) {
//                     $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `1pm_checkin` = ? WHERE `student_id` = ?");
//                     $update_query->bind_param("si", $current_time_str, $student_id);
//                     if ($update_query->execute() && $update_query->affected_rows > 0) {
//                         return "1 PM check-in recorded for student ID: " . $student_id;
//                     } else {
//                         return "1 PM check-in already recorded or failed to update.";
//                     }
//                 } elseif ($current_time >= $Time4) {
//                     $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `5pm_checkout` = ? WHERE `student_id` = ?");
//                     $update_query->bind_param("si", $current_time_str, $student_id);
//                     if ($update_query->execute() && $update_query->affected_rows > 0) {
//                         return "5 PM checkout recorded for student ID: " . $student_id;
//                     } else {
//                         return "5 PM checkout already recorded or failed to update.";
//                     }
//                 } else {
//                     return "Invalid check-in/check-out time.";
//                 }
//             } else {
//                 return "Failed to insert new attendance record.";
//             }
        // } else {
        //     // The student already exists in ws_attendance, check time and update
        //     if ($Time1 <= $current_time && $current_time < $Time2) {
        //         $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `8am_checkin` = ? WHERE `student_id` = ?");
        //         $update_query->bind_param("si", $current_time_str, $student_id);
        //         if ($update_query->execute() && $update_query->affected_rows > 0) {
        //             return "8 AM check-in recorded for student ID: " . $student_id;
        //         } else {
        //             return "8 AM check-in already recorded or failed to update.";
        //         }
        //     } elseif ($Time2 <= $current_time && $current_time < $Time3) {
        //         $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `12pm_checkout` = ? WHERE `student_id` = ?");
        //         $update_query->bind_param("si", $current_time_str, $student_id);
        //         if ($update_query->execute() && $update_query->affected_rows > 0) {
        //             return "12 PM checkout recorded for student ID: " . $student_id;
        //         } else {
        //             return "12 PM checkout already recorded or failed to update.";
        //         }
        //     } elseif ($Time3 <= $current_time && $current_time < $Time4) {
        //         $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `1pm_checkin` = ? WHERE `student_id` = ?");
        //         $update_query->bind_param("si", $current_time_str, $student_id);
        //         if ($update_query->execute() && $update_query->affected_rows > 0) {
        //             return "1 PM check-in recorded for student ID: " . $student_id;
        //         } else {
        //             return "1 PM check-in already recorded or failed to update.";
        //         }
        //     } elseif ($current_time >= $Time4) {
        //         $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `5pm_checkout` = ? WHERE `student_id` = ?");
        //         $update_query->bind_param("si", $current_time_str, $student_id);
        //         if ($update_query->execute() && $update_query->affected_rows > 0) {
        //             return "5 PM checkout recorded for student ID: " . $student_id;
        //         } else {
        //             return "5 PM checkout already recorded or failed to update.";
        //         }
        //     } else {
        //         return "Invalid check-in/check-out time.";
        //     }
        // }
//     } else {
//         return "Invalid card number!";
//     }
// }


//     public function fetch($date) {
//         $qry = $this->conn->prepare("SELECT * FROM `ws_attendance` AS a 
//                                      INNER JOIN `ws_students` AS s 
//                                      ON a.student_id = s.student_id 
//                                      WHERE a.date = ?");
//         $qry->bind_param('s', $date);
//         $qry->execute();
//         $result = $qry->get_result();

//         return $result;
//     }
// }
// ?>

<?php 
include_once("db.php");

class db extends Database {
    
    public function __construct() {
        $this->dbconnect();
    }

    function query($qry){
        $qry = $this->conn->query($qry);
        return $qry;
    }

    public function login($card_number) {
        // Set the timezone to Asia/Kuala Lumpur
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $query = $this->conn->prepare("SELECT `student_id` FROM `ws_students` WHERE `card_number` = ?");
        $query->bind_param("s", $card_number);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();

        if ($result->num_rows == 1) {
            $student_id = $row['student_id'];
            $current_time = new DateTime();
            $current_time_str = $current_time->format('H:i:s'); // Current time as string

            // Define the time intervals for checking in and out
            $Time1 = new DateTime("08:00:00");
            $Time2 = new DateTime("12:00:00");
            $Time3 = new DateTime("13:00:00");
            $Time4 = new DateTime("17:00:00");

            $qry = $this->conn->prepare("SELECT * FROM `ws_attendance` WHERE `student_id` = ? AND `date` = CURDATE()");
            $qry->bind_param("i", $student_id);
            $qry->execute();
            $result = $qry->get_result();

            if ($result->num_rows == 0) {
                // Insert a new row for the student if not exists
                $in_query = $this->conn->prepare("INSERT INTO `ws_attendance` (`student_id`, `date`) VALUES (?, CURDATE())");
                $in_query->bind_param("i", $student_id);
                if (!$in_query->execute()) {
                    return false;
                }
            }

            // Check-in and check-out logic
            if ($Time1 <= $current_time && $current_time < $Time2) {
                $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `8am_checkin` = ? WHERE `student_id` = ? AND `date` = CURDATE()");
                $update_query->bind_param("si", $current_time_str, $student_id);
                return $update_query->execute() && $update_query->affected_rows > 0;
            } elseif ($Time2 <= $current_time && $current_time < $Time3) {
                $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `12pm_checkout` = ? WHERE `student_id` = ? AND `date` = CURDATE()");
                $update_query->bind_param("si", $current_time_str, $student_id);
                return $update_query->execute() && $update_query->affected_rows > 0;
            } elseif ($Time3 <= $current_time && $current_time < $Time4) {
                $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `1pm_checkin` = ? WHERE `student_id` = ? AND `date` = CURDATE()");
                $update_query->bind_param("si", $current_time_str, $student_id);
                return $update_query->execute() && $update_query->affected_rows > 0;
            } elseif ($current_time >= $Time4) {
                $update_query = $this->conn->prepare("UPDATE `ws_attendance` SET `5pm_checkout` = ? WHERE `student_id` = ? AND `date` = CURDATE()");
                $update_query->bind_param("si", $current_time_str, $student_id);
                return $update_query->execute() && $update_query->affected_rows > 0;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function fetch($date) {
        $qry = $this->conn->prepare("SELECT * FROM `ws_attendance` AS a 
                                     INNER JOIN `ws_students` AS s 
                                     ON a.student_id = s.student_id 
                                     WHERE a.date = ?");
        $qry->bind_param('s', $date);
        $qry->execute();
        $result = $qry->get_result();

        return $result;
    }

    public function admin($student_name,$card_number){
        $qry = $this->conn->prepare("SELECT `student_id` FROM `ws_students` WHERE `student_name` = ? AND `card_number` = ?");
        $qry -> bind_param("ss",$student_name,$card_number);
        $qry -> execute();
        $result = $qry -> get_result();
            if ($result->num_rows == 0) {
                # code...
                $insert_qry = $this->conn->prepare("INSERT INTO `ws_students`(`student_name`,`card_number`) VALUES (?,?)");
                $insert_qry -> bind_param("ss",$student_name,$card_number);
                $insert_qry -> execute();

                return $insert_qry;
        }
    }
}

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


