<?php
session_start();

require_once('config.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])){
	$user_login = $_POST['username'];
	$passwrd_login = $_POST['password'];
	$sql = "SELECT id,username,fname,lname,user_pass,user_role FROM user";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			if($row['username'] == $user_login && $row['user_pass'] == $passwrd_login){
				$_SESSION['username'] = $row['username'];
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['lname'] = $row['lname'];
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['user_role'] = $row['user_role'];
				if($row['user_role']=="secretary"){
					header('Location: secretary/secretary.php#profile');
					exit;
				}
				else if($row['user_role']=="instructor"){
					header("Location: instructor/instructor.php#profile");
					exit;
				}
				else if($row['user_role']=="student"){
					header("Location: student/student.php#profile");
					exit;
				}
				else{
					echo "error";
				}
			}
		}
	}
}
