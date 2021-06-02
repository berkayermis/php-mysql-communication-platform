<?php
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$x = $_SESSION['user_id'];

$query = "INSERT INTO user_course (userr_id,course_id) VALUES (?,?)";
// $check = 'SELECT DISTINCT course.course_name FROM user_course,course WHERE  user_course.userr_id = 1';
// $result = mysqli_query($conn,$check);
// if(mysqli_num_rows($result)>0){
//   while($row = mysqli_fetch_assoc($result)){

//   } 
// }
$statement = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($statement,'ii',$x,$_GET['code']);
mysqli_stmt_execute($statement);
print(mysqli_stmt_error($statement) . "\n");
mysqli_stmt_close($statement);
$message = "User_course was updated succesfully!";
echo "<script type='text/javascript'>alert('$message');</script>"; 


header("Location: student.php#taken-course");
exit;
?>
