<?php  
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$userID = $_SESSION['user_id'];

$sql = 'SELECT fname,lname FROM user,user_course 
WHERE user_course.userr_id=user.id AND user_course.course_id = "'.$_GET['info'].'"';

$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "First Name" . "\t" . "Last Name" . "\t";  
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
header("Content-Disposition: attachment; filename=Registered-Students.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?>