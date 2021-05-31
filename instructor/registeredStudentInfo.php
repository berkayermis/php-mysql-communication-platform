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

      <div id="student-list" class="">
            <span onclick="location.href ='instructor.php#course'" class="close" title="Close Modal">&times;</span>            
            <div class="list">
              
          <div class="dropdown">
            <button class="download-button">Download</button>
            <div class="dropdown-content">
            <a href="../files/student list.xls" download>.xls</a>
            <a href="../files/student list.pdf" download>.pdf</a>
            </div>
          </div>
                <ol>
                <?php
                    require_once('../config.php');
                  
                    $conn = mysqli_connect($servername, $username, $password,$db);
                
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = 'SELECT fname,lname FROM user,user_course 
                    WHERE user_course.userr_id=user.id AND user_course.course_id = "'.$_GET['info'].'" ';
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<li>" . $row['fname'] . " " . $row['lname'] . "</li>";
                        }
                        echo "</ol>" . "</div>" . "</div>";
                    }
                ?>
    
</body>
</html>