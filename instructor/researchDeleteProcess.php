<?php
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql='DELETE FROM request WHERE instructor_id = '.$_SESSION['user_id'].' AND request_user_id = "'.$_GET['std'].'" ';

if (mysqli_query($conn, $sql)) {
  echo "success";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

header("Location: instructor.php#research");
exit;

exit;