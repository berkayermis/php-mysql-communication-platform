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
 
                  $sql = 'SELECT course.id AS D, course.code AS B, course.course_name AS A, course.course_type AS C FROM course WHERE course.instructor_id="'.$_SESSION['user_id'].'"';
                  $sql2 = 'SELECT COUNT(A.userr_id) AS total, A.course_id AS K FROM user_course AS A GROUP BY A.course_id';
                  $result = mysqli_query($conn,$sql);
                  $result2 = mysqli_query($conn,$sql2);
                  $count = 0;
                  if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>" . 
                        "<td>" . '<input type="file" id="myfile" name="myfile" multiple>' . "</td>" . 
                        "<td>" . $row['B'] . "</td>" . 
                        "<td>" . $row['A'] . "</td>". 
                        "<td>" . $row['C'] . "</td>";
                        while($row_sec = mysqli_fetch_assoc($result2)){
                          if($row_sec['K']==$row['D']){
                            echo "<td>". $row_sec['total'] ."</td>";
                          }
                        //   if($row_sec['K']==$row['D']) {
                        //     echo "<td>". $row_sec['total'] ."</td>";
                        //     break;
                        //   }
                        //   else{
                        //     $count++;
                        //     if($count==6){
                        //       echo "<td>" . "ZERO" . "</td>";
                        //       break;
                        //     }
                        //   }
                        // }
                        // $count = 0;
                        // echo "<td> test </td> </tr>";
                      }
                      echo "<td> test </td> </tr>";
                    }
                  }

                ?>
              <!-- <tr>
                <td><input type="file" id="myfile" name="myfile" multiple></td>
                <td>COE3149681</td>
                <td>Principle of Programming Languages	</td>
                <td>Mandatory</td>
                <td>34</td>
                <td><a onclick="document.getElementById('student-list').style.display='block'" href="#course"><i class="fas fa-bars"></i></a></td>
              </tr>
              <tr>
                <td><input type="file" id="myfile" name="myfile" multiple></td>
                <td>COE3149680</td>
                <td>Computer Organization	</td>
                <td>Mandatory</td>
                <td>44</td>
                <td><a onclick="document.getElementById('student-list').style.display='block'" href="#course"><i class="fas fa-bars"></i></a></td>
              </tr>
              <tr>
                <td><input type="file" id="myfile" name="myfile" multiple></td>
                <td>COE2146020</td>
                <td>Advanced Programming	</td>
                <td>Elective</td>
                <td>57</td>
                <td><a onclick="document.getElementById('student-list').style.display='block'" href="#course"><i class="fas fa-bars"></i></a></td>
              </tr>
              <tr>
                <td><input type="file" id="myfile" name="myfile" multiple></td>
                <td>COE3149683</td>
                <td>Introduction to Programming	</td>
                <td>Mandatory</td>
                <td>80</td>
                <td><a onclick="document.getElementById('student-list').style.display='block'" href="#course"><i class="fas fa-bars"></i></a></td>
              </tr> -->
            </tbody>
          </table> 

          <div id="student-list" class="modal">
            <span onclick="document.getElementById('student-list').style.display='none'" class="close" title="Close Modal">&times;</span>            
            <div class="list">
              
          <div class="dropdown">
            <button class="download-button">Download</button>
            <div class="dropdown-content">
            <a href="../files/student list.xls" download>.xls</a>
            <a href="../files/student list.pdf" download>.pdf</a>
            </div>
          </div>

              <ol>
                <li>Berkay Ermiş</li>
                <li>Fatih Furkan Ak</li>
                <li>Ceren İşlekli</li>
                <li>D</li>
                <li>E</li>
                <li>F</li>
                <li>G</li>
                <li>J</li>
                <li>AA</li>
                <li>BB</li>
                <li>CC</li>
                <li>DD</li>
                <li>EE</li>
                <li>FF</li>
                <li>JJ</li>
                <li>KK</li>
                <li>LL</li>
                <li>MM</li>
                <li>NN</li>
                <li>OO</li>
                <li>PP</li>
                <li>SS</li>
                <li>JK</li>
                <li>ASD</li>
                <li>AWE</li>
                <li>AED</li>
                <li>ADX</li>
                <li>AZX</li>
                <li>BTC</li>
                <li>ETH</li>
                <li>LKJ</li>
                <li>UBS</li>
                <li>PTS</li>
                <li>KHS</li>
              </ol>
            </div>
          </div>
       </section>

       <section id='research'>
        <div>
          <a onclick="document.getElementById('research-requests').style.display='block'" href="#research" class="notification" >            
            <span style="line-height: 6vh;">Request</span>
            <span class="badge">
            <?php
              require_once('../config.php');
                  
              // Create connection
              $conn = mysqli_connect($servername, $username, $password,$db);
          
              // Check connection
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
                  
             // Create connection
             $conn = mysqli_connect($servername, $username, $password,$db);
         
             // Check connection
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


              <!-- <li>Calculus</li>
              <li>Physics</li>
              <li>Advanced Programming</li> -->
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
                    echo "<tr>" . 
                    "<td>" . "<a>" . "<i class='fas fa-folder'>" . "</i>" . "</a>" . "</td>" . 
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