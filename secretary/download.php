<?php  
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$userID = $_SESSION['user_id'];

$sql = 'SELECT course.id,course.code,course.course_name,course.course_type,course.instructor_id
FROM course,user WHERE user.id=course.instructor_id';

$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "ID" . "\t" . "Code" . "\t" . "Course Name" . "\t". "Course Type" . "\t" .  "Instructor ID" . "\t"; 
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Courses.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?>