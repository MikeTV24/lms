<?php
include('dbcon.php');

$un = $_POST['un'];
$fn = $_POST['fn'];
$ln = $_POST['ln'];
$class_id = $_POST['class_id'];

$sql = "SELECT * FROM student WHERE username = '$un'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo 'error_username';
} else {
    mysqli_query($conn, "insert into student (username,firstname,lastname,location,class_id,status)
		values ('$un','$fn','$ln','uploads/NO-IMAGE-AVAILABLE.jpg','$class_id','Unregistered')                                    
		") or die(mysqli_error());
    echo 'success';
}
?>