<?php
session_start();
?>
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
        <a href="#course"><img class="icon-logo-width" src="../icons/school-logo.png" alt=""></a><hr>
        <a href="#profile"><i class="far fa-user"></i></a>
        <a href="#course"><i class="fas fa-book"></i></a>
        <a href="#research"><i class="fas fa-flask"></i></a>
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
              <h2>Courses</h2>
            </caption>
            <thead>
              <tr>
                <th>Upload Material</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Type</th>
                <th>Registered Students</th>
                <th>Options</th>
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

                  $sql = 'SELECT A.course_id,course.id,course_name,course.code,course.course_type,COUNT(A.userr_id) AS total
                  FROM user_course AS A,course,user WHERE course.instructor_id=user.id AND course.id=A.course_id AND course.instructor_id="'.$_SESSION['user_id'].'" GROUP BY course_name';
                  $result = mysqli_query($conn,$sql);
                  $sql2 = 'SELECT course_name,course.id,course.code,course.course_type
                  FROM course WHERE course.id NOT IN (SELECT A.course_id FROM user_course AS A) AND course.instructor_id= "'.$_SESSION['user_id'].'" ';
                  $result2 = mysqli_query($conn,$sql2);
                  // $count = 0;
                  if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_assoc($result)){
                        $courseInfo = $row['course_id'];
                        echo "<tr>" . 
                        // "<td>" . '<input type="file" id="myfile" name="myfile" multiple>' . "</td>" . 
                        "<td>" . "<button onclick=\"location.href = 'uploadmaterial.php?info=$courseInfo'\"  class='approval-button'>" . "Upload" . '</button>' . "</td>" .
                        "<td>" . $row['code'] . "</td>" . 
                        "<td>" . $row['course_name'] . "</td>". 
                        "<td>" . $row['course_type'] . "</td>" . 
                        "<td>" . $row['total'] . "</td>" . 
                        "<td>" . "<a href='registeredStudentInfo.php?info=$courseInfo'>". "<i class=\"fas fa-bars\">" . "</i>" . "</a>" . "</td>" . "</tr>";
                    }
                  }
                  if(mysqli_num_rows($result2)>0){
                    while($row2 = mysqli_fetch_assoc($result2)){
                      $courseInfoSecond = $row2['id'];
                      echo "<tr>" . 
                      "<td>" . "<button onclick=\"location.href = 'uploadmaterial.php?info=$courseInfoSecond'\"  class='approval-button'>" . "Upload" . '</button>' . "</td>" .
                      "<td>" . $row2['code'] . "</td>" . 
                      "<td>" . $row2['course_name'] . "</td>". 
                      "<td>" . $row2['course_type'] . "</td>" . 
                      "<td>" . 0 . "</td>" . 
                      "<td>" . "<a href='registeredStudentInfo.php?info=$courseInfoSecond'>". "<i class=\"fas fa-bars\">" . "</i>" . "</a>" . "</td>" . "</tr>";
                    }
                  }


                ?>
            </tbody>
          </table> 
       </section>

       <section id='research'>
        <div>
          <a onclick="document.getElementById('research-requests').style.display='block'" href="#research" class="notification" >            
            <span style="line-height: 6vh;">Request</span>
            <span class="badge">
            <?php
              require_once('../config.php');
                  
              $conn = mysqli_connect($servername, $username, $password,$db);
          
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              $request_sql = 'SELECT COUNT(R.id) AS C FROM request AS R WHERE R.instructor_id ="'.$_SESSION['user_id'].'"';
              $request_result = mysqli_query($conn,$request_sql);
              if(mysqli_num_rows($request_result)>0){
                while($request_row = mysqli_fetch_assoc($request_result)){
                  echo $request_row['C'];
                }
              }
              else{
                
              }
            ?>
            </span></a>
        </div>

        <table class="research-table" id="course-table">
          <caption>
            <h2>Research Group</h2>
          </caption>
          <thead>
            <tr>
              <th>Student ID</th>
              <th>First name</th>
              <th>Last Name</th>
              <th>GPA</th>
              <th>Class</th>
              <th>Student Information</th>
            </tr>
          </thead>
          <tbody>
          <?php
             require_once('../config.php');
                  
             $conn = mysqli_connect($servername, $username, $password,$db);
         
             if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
             }

             $sql = 'SELECT * FROM student_research_group AS SRG, student_information AS SI, user AS U
             WHERE U.id = SRG.student_id AND SRG.student_id = SI.student_id AND SRG.instructor_id ="'.$_SESSION['user_id'].'" ';
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_assoc($result)){
                $x = $row['student_id'];
                echo "<tr>" . 
                "<td>" . $row['student_no'] . "</td>" . 
                "<td>" . $row['fname'] . "</td>" . 
                "<td>" . $row['lname'] . "</td>" . 
                "<td>" . $row['gpa'] . "</td>" . 
                "<td>" . $row['class'] . "</td>" . 
                "<td>" . 
                "<a onclick=\"document.getElementById('student-information').style.display='block'\" href='info.php?info=$x'>" . "<i class=\"fas fa-search\">" . "</i>" . "</a>" . "</td>" . "</tr>";
              }
            }
          ?>
          </tbody>
        </table> 

        <div id="research-requests" class="modal">
          <span onclick="document.getElementById('research-requests').style.display='none'" class="close" title="Close Modal">&times;</span>            
          <div>
            <table>
              <thead>
                <tr>
                  <th>Material</th>
                  <th>Student Name</th>
                  <th>Student No</th>
                  <th>Note</th>
                  <th>Options</th>
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

                $sql = 'SELECT R.note, R.request_file,U.fname, U.lname, SI.student_no,SI.student_id FROM request AS R, user AS U, student_information AS SI
                WHERE SI.student_id = R.request_user_id AND R.request_user_id = U.id AND  R.instructor_id = "'.$_SESSION['user_id'].'"';

                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_assoc($result)){
                    $std_data = $row['student_id'];
                    $req_data = 'berkay_ermis.pdf';
                    echo "<tr>" . 
                    "<td>" . "<a href='../files/$req_data' download>" . "<i class='fas fa-folder'>" . "</i>" . "</a>" . "</td>" . 
                    "<td>" . $row['fname'] . " " . $row['lname'] .  "</td>" . 
                    "<td>" . $row['student_no'] . "</td>" . 
                    "<td>" . $row['note'] . "</td>" . 
                    "<td>" .
                    "<div class='options-section'>" . 
                         "<button onclick=\"location.href = 'requestApprovalProcess.php?std=$std_data'\"  class='approval-button'>" . "Accept" . '</button>' . "<br>" .
                         "<button onclick=\"location.href = 'requestDeleteProcess.php?std=$std_data'\"  class='reject-button'>" . "Reject" . '</button>' . 
                    "</div>" . 
                    "</td>" . 
                    "</tr>";
                  }
                }
              ?>

                <!-- <tr>
                  <td><a href="../files/berkay_ermis.pdf" download><i class="fas fa-folder"></i></a></td>
                  <td>Berkay Ermiş</td>
                  <td>64170024</td>
                  <td>Hello dear {name}, .....</td>
                  <td>
                    <div class="options-section">
                      <button onclick="acceptFunction()" class="approval-button">Accept</button>
                      <button onclick="rejectFunction()" class="reject-button">Reject</button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td><a href="../files/fatih_furkan_ak.pdf" download><i class="fas fa-folder"></i></a></td>
                  <td>Fatih Furkan Ak</td>
                  <td>64170032</td>
                  <td>Hello dear {name}, .....</td>
                  <td>
                    <div class="options-section">
                      <button onclick="acceptFunction()" href="#research" class="approval-button">Accept</button>
                      <button onclick="rejectFunction()" class="reject-button">Reject</button>
                    </div>
                  </td>
                </tr> -->
              </tbody>
            </table>
            </div>
        </div>
        
      </section>
       
      <section id= 'message'>
        <h1>Message</h1>
       </section>
     </div>

     <script>
       function acceptFunction(){
          alert("Student was accepted!");
       }

       function rejectFunction(){
          alert("Student was rejected!");
       }
     </script>
     
</body>
</html>