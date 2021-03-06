<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4f74b84bed.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <a href="#course"><img class="icon-logo-width" src="../icons/school-logo.png" alt=""></a> <hr>
        <a href="#profile"><i class="far fa-user"></i></a>
        <div class="dropdown">
          <a href="#course"><i class="fas fa-book"></i></a>
          <div class="dropdown-content">
          <a href="#course">Courses</a>
          <a href="#taken-course">Taken Courses</a>
          </div>
        </div>
        <a href="#research"><img class="icon-width" src="../icons/add-research.png" alt=""></a>
        <a href="#message"><i class="far fa-envelope"></i></a>
        <a href="../main/index.php"><i class="fas fa-sign-out-alt"></i></a>
    </nav>
       
     <div class= 'container'> 
        <section id= 'logo'>
          </section>


       <section id= 'profile'>
         <h1>Welcome <?php echo $_SESSION['fname']." ". $_SESSION['lname'] ?></h1>
       </section>
       
       <section id='course'>
        <table id="course-table">
          <caption>
            <ul style="display: block;"><li><h2>Offered Courses</h2></li>
            <li style="float: inline-end;"> 
              <div class="dropdown-add-course">
                <a class="add-course" href="#course">Add Course</a>
                <div class="course-content-taken">
                <?php
                  require_once('../config.php');

                  // Create connection
                  $conn = mysqli_connect($servername, $username, $password,$db);
              
                  // Check connection
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  }

                  $sql = "SELECT id,course_name FROM course";
                  $result = mysqli_query($conn,$sql);
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                      $data_add = $row['id'];
                      echo "<a href='add.php?code=$data_add'>" . $row['course_name'] . "</a>";
                    }
                    echo "</div>";
                  }
                ?>
              </div>
            </li>
          </ul>
          </caption>
          <thead>
            <tr>
              <th>Course Code</th>
              <th>Course Name</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>
          <?php
          require_once('../config.php');

          // Create connection
          $conn = mysqli_connect($servername, $username, $password,$db);
      
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
          
          $sql = "SELECT code,course_name,course_type FROM course";
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
              echo "<tr>" . 
              "<td>" . $row['code'] . "</td>" .
              "<td>" . $row['course_name'] . "</td>" .
              "<td>" . $row['course_type'] . "</td>" . "</tr>";
            }
            echo "</tbody> </table>";
          }
          else{
            echo "</tbody> </table>";
          }
          ?>
       </section>

       <section id="taken-course">
        <table id="course-table">
          <caption>
            <ul style="display: block;"><li><h2>Taken Courses</h2></li>
            <li style="float: inline-end;"> 
              <div class="dropdown-taken">
                <a class="download-taken" href="#taken-course">Download</a>
                <div class="dropdown-content-taken">
                <a href="download.php" >.xls</a>
                <a href="../files/taken-courses.pdf" download>.pdf</a>
                </div>
              </div>
            </li>
            <li style="float: inline-end;"> 
              <div class="drop-course2">
                <a class="drop-course" href="#taken-course">Drop Course</a>
                <div class="drop-course-taken">
                <?php
             require_once('../config.php');

             // Create connection
             $conn = mysqli_connect($servername, $username, $password,$db);
         
             // Check connection
             if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
             }
             $userID = $_SESSION['user_id'];
             $sql = "SELECT course.course_name AS A , user_course.id AS ucid
             FROM course,user_course,user WHERE user_course.userr_id = $userID AND course.id = user_course.course_id AND user.id = $userID ";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                $data = $row['ucid'];
                echo "<a href='drop.php?code=$data'>" . $row['A'] . "</a>";
              }
            }
                ?>
                </div>
              </div>
            </li>
          </ul>
          </caption>
          <thead>
            <tr>
              <th>Material</th>
              <th>Course Code</th>
              <th>Course Name</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>
            <?php
             require_once('../config.php');

             // Create connection
             $conn = mysqli_connect($servername, $username, $password,$db);
         
             // Check connection
             if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
             }

             $sql = "SELECT course.id,course.course_name AS A, course.code AS B , course.course_type AS C
             FROM course,user_course,user WHERE user_course.userr_id = $userID AND course.id = user_course.course_id AND user.id = $userID ";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                $course_inf = $row['id'];
                echo "<tr>" . 
                "<td>" . "<a href='courseMaterial.php?info=$course_inf' style=\"width:auto;\">" . "<i class=\"fas fa-search\">" . "</i>" . "</a>" . "</td>" .
                "<td>" . $row['B'] . "</td>" .
                "<td>" . $row['A'] . "</td>" .
                "<td>" . $row['C'] . "</td>" . "</tr>";
              }
              echo "</tbody> </table>";
            }
            else{
              echo "</tbody> </table>";
            }
            ?>
       </section>

       <section id= 'research'>
        <table id="course-table">
          <caption>
            <ul style="display: block;"><li><h2>Research Groups</h2></li>
            <li style="float: inline-end;"> 
                <a onclick="document.getElementById('id99').style.display='block'" class="join-research" href="#research">Send Request</a>
            </li>
          </ul>
          </caption>
          <thead>
            <tr>
              <th>First name</th>
              <th>Last name</th>
              <th>Research Area</th>
            </tr>
          </thead>
          <tbody>
            <?php
              require_once('../config.php');

              // Create connection
              $conn = mysqli_connect($servername, $username, $password,$db);
          
              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              $sql = 'SELECT user.fname,user.lname,student_research_group.research_area FROM student_research_group,user 
              WHERE user.id=instructor_id AND student_id = "'.$_SESSION['user_id'].'"';
              $result = mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<tr>" . 
                  "<td>" . $row['fname'] . "</td>" . 
                  "<td>" . $row['lname'] . "</td>" . 
                  "<td>" . $row['research_area'] . "</td>". "</tr>";
                }
              }
            ?>
          </tbody>
        </table> 

        <div id="id99" class="modal">
            <span onclick="document.getElementById('id99').style.display='none'" class="close" title="Close Modal">&times;</span>            
            <form class="form" action="student.php#research" method="post">
              <h2>Send Request</h2> <br>
              <label for="recipient"><strong>Recipient</strong></label> <br>
              <select name="recipient" id="recipient">
                <?php
                require_once('../config.php');

                // Create connection
                $conn = mysqli_connect($servername, $username, $password,$db);
            
                // Check connection
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT id,fname,lname FROM user WHERE user.user_role = 'instructor'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<option>" . $row['fname'] . " " . $row['lname'] . "</option>";
                  }
                }
                ?>
              </select> <br>      
              <label type="note" for="note">Note</label> <br>       
              <textarea name="note" id="note" cols="30" rows="10" placeholder="Type a note.."></textarea> <br>              
              <label for="file">File</label> <br> 
              <input type="file" name="file"></input> <br>
              <button name="send_request">Send</button>
            </form>
        </div>
      </section>

      <?php
      if(isset($_POST['send_request'])){
        $filename = $_POST['file'];
        $recipient = $_POST['recipient'];
        $x = array();
        $x = explode(" ",$recipient);
        $search_query = "SELECT user.id FROM user WHERE fname='$x[0]' AND lname='$x[1]'";
        $search_result = mysqli_query($conn,$search_query);
        if(mysqli_num_rows($search_result) > 0){
          while($row = mysqli_fetch_assoc($search_result)){
            $recipientID = $row['id'];
          }
        }
        $note = $_POST['note'];

      
        #sql query to insert into database
        // $sql = "INSERT INTO request (request_user_id,instructor_id,note,request_file) VALUES ($userID,$recipientID,$note,$filename)";
        $query = "INSERT INTO request (request_user_id,instructor_id,note,request_file) VALUES (?,?,?,?)";
        $statement = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($statement,'iisb',$userID,$recipientID,$note,$filename);
        mysqli_stmt_execute($statement);
        print(mysqli_stmt_error($statement) . "\n");
        mysqli_stmt_close($statement);
        $message = "Request was sent succesfully!";
        echo "<script type='text/javascript'>alert('$message');</script>"; 

      }
      ?>
       
      <section id= 'message'>
        <h1>Message</h1>
       </section>
     </div>

     <script>
      function addAlertFunction(){
        alert("Course was added succesfully!");
      }

      function dropAlertFunction(){
        alert("Course was dropped!");
      }

      </script>
</body>
</html>