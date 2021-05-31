<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4f74b84bed.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
        <a href="instructor.php#course"><img class="icon-logo-width" src="../icons/school-logo.png" alt=""></a><hr>
        <a href="instructor.php#profile"><i class="far fa-user"></i></a>
        <a href="instructor.php#course"><i class="fas fa-book"></i></a>
        <a href="instructor.php#research"><i class="fas fa-flask"></i></a>
        <a href="instructor.php#message"><i class="far fa-envelope"></i></a>
        <a href="../main/index.php"><i class="fas fa-sign-out-alt"></i></a>
      </nav>

      <div id="student-information" class="">
          <span onclick="location.href ='instructor.php#research'" class="close" title="Close Modal">&times;</span>            
         
          <div class="list">
            <h3>Taken Course</h3> <br><hr> 
            <ol class="student-info-list">
            <?php 
              require_once('../config.php');
                  
              $conn = mysqli_connect($servername, $username, $password,$db);
          
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }
              
              $sql = 'SELECT * FROM user_course, course WHERE course_id=course.id AND userr_id = "'.$_GET['info'].'"';
              $resultt = mysqli_query($conn,$sql);
              if(mysqli_num_rows($resultt)>0){
                while($row = mysqli_fetch_assoc($resultt)){
                  echo "<li>" . $row['course_name'] . "</li>";
                }
              }
            ?>
            </ol>
          </div>
        </div>
    
</body>
</html>