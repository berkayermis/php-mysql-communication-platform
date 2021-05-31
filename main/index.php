<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Term Project</title>
    <link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/4f74b84bed.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

	<div>
		<img class="school-logo" src="../icons/school-logo.png" alt="">
	</div>

	  <div id="container">
		<!-- Cover Box -->
		<div class="form-wrap">
			<div class="tabs">
				<h3 class="login-tab"><a class="active" href="#login-tab-content">Login</a></h3>
				<h3 class="signup-tab"><a  href="#signup-tab-content">Sign Up</a></h3>
			</div><!--.tabs-->
	
			<div class="tabs-content">
				<div id="login-tab-content" class="active">
					<form id="signInForm" class="login-form" action="../login.php" method="post">
						<input name="username" type="text" class="input" id="user_login" autocomplete="off" placeholder="Username">
						<input name="password" type="password" class="input" id="user_pass" autocomplete="off" placeholder="Password">
						<input type="checkbox" class="checkbox" id="remember_me">
						<label for="remember_me">Remember me</label>
	
						<input id="realSignIn" type="submit" class="button" name="login" value="Login">
					</form>
					<div class="help-text">
						<p><a href="#">Forget your password?</a></p>
					</div>
				</div>

				<div id="signup-tab-content">
					<form class="signup-form" action="index.php" method="post">
						<input type="text" class="input" id="user_name" name="user_name" autocomplete="off" placeholder="Username">
						<input type="text" class="input" id="fname" name="user_fname" autocomplete="off" placeholder="First Name">
						<input type="text" class="input" id="lname" name="user_lname" autocomplete="off" placeholder="Last Name">
						<input type="password" class="input" id="user_pass" name="user_pass" autocomplete="off" placeholder="Password">
						<label class="option-class">Secretary
							<input type="radio" checked="checked" <?php if (isset($radio) && $radio=="secretary") echo "checked";?> name="radio" value="secretary">
							<span class="checkmark"></span>
						</label>
						<label class="option-class">Instructor
							<input type="radio" name="radio" <?php if (isset($radio) && $radio=="instructor") echo "checked";?> value="instructor" >
							<span class="checkmark"></span>
						</label>
						<label class="option-class">Student
							<input type="radio" name="radio" <?php if (isset($radio) && $radio=="student") echo "checked";?> value="student">
							<span class="checkmark"></span>
						</label>
						<input onclick="signupFunction()" name="register" type="submit" class="button" value="Sign Up">
					</form><!--.login-form-->
					<!-- <div class="help-text">
						<p>By signing up, you agree to our</p>
						<p><a href="#">Terms of service</a></p>
					</div> -->
				</div><!--.signup-tab-content-->
			</div><!--.tabs-content-->
		</div><!--.form-wrap-->
		
		
	  <div class="icons">
		<!-- <a href="https://www.facebook.com"><i class="fab fa-facebook-square"></i></a>
	  	<a href=""><i class="fab fa-instagram"></i>	</a> -->
			<ul class="icon-container">
				<li class="icon-item"><a href="https://www.facebook.com/medipoluniversitesi"><img src="../icons/facebook.png" alt=""></a></li>
				<li class="icon-item"><a href="https://www.instagram.com/medipolunv/"><img src="../icons/instagram.png" alt=""></a></li>
				<li class="icon-item"><a href="https://www.linkedin.com/school/medipoluniversitesi/"><img src="../icons/linkedin.png" alt=""></a></li>
				<li class="icon-item"><a href="https://twitter.com/medipolunv"><img src="../icons/twitter.png" alt=""></a></li>
			</ul>
	  </div>

	  <script>
		  function signupFunction(){
			  alert("Your account was sent to confirmation!")
		  }

		jQuery(document).ready(function($) {
		tab = $('.tabs h3 a');

		tab.on('click', function(event) {
			event.preventDefault();
			tab.removeClass('active');
			$(this).addClass('active');

			tab_content = $(this).attr('href');
			$('div[id$="tab-content"]').removeClass('active');
			$(tab_content).addClass('active');
	});
});
		  
	</script>

<?php
require_once('../config.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['register'])){
	$usern = $_POST['user_name'];
	$firstn = $_POST['user_fname'];
	$lastn = $_POST['user_lname'];
	$passwrd = $_POST['user_pass'];
	$user_type = test_input($_POST['radio']);
	

	$query = "INSERT INTO user (username,fname,lname,user_pass,user_role) VALUES (?,?,?,?,?)";
	$statement = mysqli_prepare($conn,$query);
	mysqli_stmt_bind_param($statement,'sssss',$usern,$firstn,$lastn,$passwrd,$user_type);
	mysqli_stmt_execute($statement);
	print(mysqli_stmt_error($statement) . "\n");
	mysqli_stmt_close($statement);

	$sql = "SELECT id FROM user WHERE user.username='$usern' AND user.fname='$firstn' AND user.lname='$lastn' AND user.user_role='$user_type'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$_SESSION['user_reg_id'] = $row['id'];
	}

	function random_float($start_number = 2,$end_number = 4,$mul = 1000){
		return mt_rand($start_number * $mul,$end_number * $mul)/$mul;}

	if($user_type == "student"){
		$std_no = rand(60000000,70000000);
		$std_gpa = random_float(2,4);
		$std_class = rand(1,4);
		$query_info = "INSERT INTO student_information (student_id,student_no,gpa,class) VALUES (?,?,?,?)";
		$statement_info = mysqli_prepare($conn,$query_info);
		mysqli_stmt_bind_param($statement_info,'iidi',$_SESSION['user_reg_id'],$std_no,$std_gpa,$std_class);
		mysqli_stmt_execute($statement_info);
		print(mysqli_stmt_error($statement_info) . "\n");
		mysqli_stmt_close($statement_info);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }

mysqli_close($conn);
?>

</body>
</html>
