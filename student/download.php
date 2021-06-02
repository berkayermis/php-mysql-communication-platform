<?php  
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$userID = $_SESSION['user_id'];

$sql = "SELECT course.id,course.course_name AS A, course.code AS B , course.course_type AS C
FROM course,user_course,user WHERE user_course.userr_id = $userID AND course.id = user_course.course_id AND user.id = $userID ";

$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "id" . "\t" . "Course Name" . "\t" . "Code" . "\t". "Type"."\t";  
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
header("Content-Disposition: attachment; filename=All_Courses.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?>