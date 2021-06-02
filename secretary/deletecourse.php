<?php
session_start();

require_once('../config.php');

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql='DELETE FROM course WHERE id = "'.$_GET['info'].'" ';

if (mysqli_query($conn, $sql)) {
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

$message = "Course was deleted succesfully!";
echo "<script type='text/javascript'>alert('$message');</script>"; 

header("Location: secretary.php#course");
exit;