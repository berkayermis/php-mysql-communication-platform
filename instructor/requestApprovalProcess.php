<?php
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$research_areas = array("Deep Learning for Odor Sensing","Projection Vein Finder",
"Design of a Linear High Power Amplifier","Small Object Detection and tracking in WAS videos","Healthcare Systems Modeling and Simulation",
"Advanced Computational Biophysics Lab for Designing Targeted and Safe Therapeutic Molecules",
"Innovative Polymer Nanotherapeutics Research Group","Computational Cameras and Vision Research Lab",
"Communications Signal Processing and Networking Center");

$instructorID = $_SESSION['user_id'];
$studentID = $_GET['std'];
$randNo = rand(1,8);

$query = "INSERT INTO student_research_group (student_id,instructor_id,research_area) VALUES (?,?,?)";
$statement = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($statement,'iis',$studentID,$instructorID,$research_areas[$randNo]);
mysqli_stmt_execute($statement);
print(mysqli_stmt_error($statement) . "\n");
mysqli_stmt_close($statement);
$message = "Research group was added into student succesfully!";
echo "<script type='text/javascript'>alert('$message');</script>"; 

$sql='DELETE FROM request WHERE instructor_id = '.$_SESSION['user_id'].' AND request_user_id = "'.$_GET['std'].'" ';

if (mysqli_query($conn, $sql)) {
  echo "success";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

header("Location: instructor.php#research");
exit;