<?php
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// "'.$_GET['ucid'].'"'

// $x = $_GET['code'];
// $sql = "DELETE FROM user_course WHERE id=$x";
$sql='DELETE FROM user_course WHERE user_course.id = "'.$_GET['code'].'" ';

if (mysqli_query($conn, $sql)) {
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

$message = "Course was dropped succesfully!";
echo "<script type='text/javascript'>alert('$message');</script>"; 

header("Location: student.php#taken-course");
exit;

?>
