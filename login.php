<?php
include('admin/dbcon.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

// -----------------------------------------STUDENT ----------------------------------------------------

$query_teach = "SELECT * FROM teacher WHERE username='$username'";
$result_teach = mysqli_query($conn, $query_teach) or die(mysqli_error());
$row_teach = mysqli_fetch_array($result_teach);

$query_stud = "SELECT * FROM student WHERE username='$username'";
$result_stud = mysqli_query($conn, $query_stud) or die(mysqli_error());
$row_stud = mysqli_fetch_array($result_stud);

if ($result_stud) {
	if ($row_stud['password'] === '') {
		$result_st = mysqli_query($conn, "update student set password='$password', status='Registered' where username = '$username'") or die(mysqli_error());
		if ($result_st) {
			$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn, $query) or die(mysqli_error());
			$row = mysqli_fetch_array($result);
			$num_row = mysqli_num_rows($result);
			if ($num_row > 0) {
				$_SESSION['id'] = $row['student_id'];
				echo 'true_student';
			}
		}
	} else {
		$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $query) or die(mysqli_error());
		$row = mysqli_fetch_array($result);
		$num_row = mysqli_num_rows($result);
		if ($num_row > 0) {
			$_SESSION['id'] = $row['student_id'];
			echo 'true_student';
		}
	}
}else if ($result_teach) {
	if ($row_teach['password'] === '') {
		$result_teacher = mysqli_query($conn, "update teacher set password='$password', teacher_status='Registered' where username = '$username'") or die(mysqli_error());
		if ($result_teacher) {
			$query_teacher = "SELECT * FROM teacher WHERE username='$username' AND password='$password'";
			$result_teacher = mysqli_query($conn, $query_teacher) or die(mysqli_error());
			$row_teacher = mysqli_fetch_array($result_teacher);
			$num_row_teacher = mysqli_num_rows($result_teacher);
			if ($num_row_teacher > 0) {
				$_SESSION['id'] = $row_teacher['teacher_id'];
				echo 'true';
			}
		}
	} else {
		$query_teacher = "SELECT * FROM teacher WHERE username='$username' AND password='$password'";
		$result_teacher = mysqli_query($conn, $query_teacher) or die(mysqli_error());
		$row_teacher = mysqli_fetch_array($result_teacher);
		$num_row_teacher = mysqli_num_rows($result_teacher);
		if ($num_row_teacher > 0) {
			$_SESSION['id'] = $row_teacher['teacher_id'];
			echo 'true';
		}
	}
}

// if ($result_stud) {
// 	$result_st = mysqli_query($conn, "update student set password='$password', status='Registered' where username = '$username'") or die(mysqli_error());

// } else if ($result_teach && $result_teach['password'] === '') {
// 	$result_teacher = mysqli_query($conn, "update teacher set password='$password', teacher_status='Registered' where username = '$username'") or die(mysqli_error());
// }
// $query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
// $result = mysqli_query($conn, $query) or die(mysqli_error());
// $row = mysqli_fetch_array($result);
// $num_row = mysqli_num_rows($result);


// // ---------------------------------------- TEACHER ------------------------------------------------------

// $query_teacher = mysqli_query($conn, "SELECT * FROM teacher WHERE username='$username' AND password='$password'") or die(mysqli_error());
// $row_teahcer = mysqli_fetch_array($query_teacher);
// $num_row_teacher = mysqli_num_rows($query_teacher);

// if ($num_row > 0) {
// 	$_SESSION['id'] = $row['student_id'];
// 	echo 'true_student';
// } else if ($num_row_teacher > 0) {
// 	$_SESSION['id'] = $row_teahcer['teacher_id'];
// 	echo 'true';

// } else {
// 	echo 'false';
// }
?>