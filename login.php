<?php
session_start();
include('admin/dbcon.php');

if (isset($_POST["username"]) && isset($_POST["password"])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	//STUDENTS

	$sql = "SELECT * FROM student WHERE username = '$username'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		if ($row['password'] == "") {
			$sql = "UPDATE student SET password = '$password', status = 'Registered' WHERE username = '$username'";
			if ($conn->query($sql) === TRUE) {
				$_SESSION['id'] = $row['student_id'];
				echo 'true_student';
			}
		} else if ($row['password'] == $password) {
			$_SESSION['id'] = $row['student_id'];
			echo 'true_student';
		}
	}

	//TEACHERS

	$sql = "SELECT * FROM teacher WHERE username = '$username'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		if ($row['password'] == "") {
			$sql = "UPDATE teacher SET password = '$password', teacher_status ='Registered' WHERE username = '$username'";
			if ($conn->query($sql) === TRUE) {
				$_SESSION['id'] = $row['teacher_id'];
				echo 'true';
			}
		} else if ($row['password'] == $password) {
			$_SESSION['id'] = $row['teacher_id'];
			echo 'true';
		}
	}
}


// /* student */
// 	$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
// 	$result = mysqli_query($conn,$query)or die(mysqli_error());
// 	$row = mysqli_fetch_array($result);
// 	$num_row = mysqli_num_rows($result);
// /* teacher */
// $query_teacher = mysqli_query($conn,"SELECT * FROM teacher WHERE username='$username' AND password='$password'")or die(mysqli_error());
// $num_row_teacher = mysqli_num_rows($query_teacher);
// $row_teahcer = mysqli_fetch_array($query_teacher);
// if( $num_row > 0 ) { 
// $_SESSION['id']=$row['student_id'];
// echo 'true_student';	
// }else if ($num_row_teacher > 0){
// $_SESSION['id']=$row_teahcer['teacher_id'];
// echo 'true';

//  }else{ 
// 		echo 'false';
// }	

?>