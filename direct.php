<?php
session_start();

require_once('config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "success";
}

$x = $_SESSION['user_id'];
$y = $_SESSION['courses_id'];
$query = "INSERT INTO user_course (userr_id,course_id) VALUES (?,?)";
$statement = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($statement,'ii',$x,$y);
mysqli_stmt_execute($statement);
print(mysqli_stmt_error($statement) . "\n");
mysqli_stmt_close($statement);
$message = "User_course was updated succesfully!";
echo "<script type='text/javascript'>alert('$message');</script>"; 


header("Location: student/student.php#course");
exit;
?>
