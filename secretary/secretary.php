<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4f74b84bed.js" crossorigin="anonymous"></script>

</head>
<body>

  <div>
    <ul>
      <li>        
        <nav>
        <a href="#course"><img class="icon-logo-width" src="../icons/school-logo.png" alt=""></a><hr>
        <a href="#profile"><i class="far fa-user"></i></a>
        <a href="#course"><i class="fas fa-book"></i></a>
        <a href="#message"><i class="far fa-envelope"></i></a>
        <a href="../main/index.php"><i class="fas fa-sign-out-alt"></i></a>
      </nav>
    </li>

      <li class="flex-item">
          <div class='container2'> 

           <section id= 'profile'>
             <h1>Profile</h1>
           </section>
           
           <section id='message'>
            <h1>Message</h1>
           </section>

           <section id='course'> 

           <div id="idcreate-course" class="modal">
                <span onclick="document.getElementById('idcreate-course').style.display='none'" class="close" title="Close Modal">&times;</span>            
                <form class="form" method="post" action="secretary.php">
                  <label for="">Course Code</label> <br> 
                  <input type="number" min="1" max="100000" value="Course code" name="course_code"><br>
                  <label for="">Course Name</label>
                  <input type="text" id="cname" name="cname" placeholder="Course name" >
                  <label for="course-type">Course Type</label> <br>
                <select name="course_type" id="course-type">
                  <option value="Mandatory">Mandatory</option>
                  <option value="Elective">Elective</option>
                </select> <br>
                <label for="instructor">Instructor</label> <br>
                <select name="instructor" id="instructor">
                  <?php 
                require_once('../config.php');
                $ins_conn = mysqli_connect($servername, $username, $password,$db);
            
                if (!$ins_conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }
                else{
                  echo "error";
                }
                  $ins_sql = "SELECT id,fname,lname,user_role FROM user WHERE user_role='instructor' ";
                  $ins_result = mysqli_query($ins_conn,$ins_sql);
                  if(mysqli_num_rows($ins_result)>0){
                    while($ins_row = mysqli_fetch_assoc($ins_result)){
                      $instructor_id = $ins_row['id'];
                      echo "<option>" . $ins_row['fname'] . " " . $ins_row['lname'] . "</option>";
                    }
                    echo "</select>";
                  }
                  else{
                    echo "error";
                  }
                  ?>
                <label for="date">Date</label>
                <input type="datetime-local" id="date" name="date"> <br>
                <button name="create_course_button" type="submit">Create Course</button>
                </form>
            </div>

             <div style="display: inline-block;">
              <div>
                <a onclick="document.getElementById('idcreate-course').style.display='block'" href="#course" class="create-course-btn" ><p>Create Course</p></a>
              </div>

              <div class="dropdown">
                <button href="#course" class="create-course-btn2">Department</button>
                <div class="dropdown-content">
                <a href="#course">Computer Engineering</a>
                <a href="#course">Electrics Engineering</a>
                <a href="#course">Biomedical Engineering</a>
                <a href="#course">Industrial Engineering</a>
                <a href="#course">Civil Engineering</a>
                </div>
              </div>
              
              <div class="dropdown2">
                <button href="#course" class="create-course-btn3">Download</button>
                <div class="dropdown-content2">
                <a href="../files/all-courses.xls" download="">.xls</a>
                <a href="../files/all-courses.pdf" download>.pdf</a>
                </div>
              </div>

             </div>

              <table id="course-table">
                <caption>
                  <h2>All Courses</h2>
                </caption>
                <thead>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Type</th>
                    <th>Instructor</th>
                    <th>Time</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
          </section>
           
         </div>

      </li>
    </ul>
  </div>
  

  <script>
    function deleteFunction() {
    if (confirm("Are you sure to delete?")) {
      alert("Course was deleted!");
  }
    else {
    }
}
    </script>

    <?php
    require_once('../config.php');

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    function delete_data($data){
      $sql_delete = "DELETE FROM course WHERE id='$data' ";
    
      if (mysqli_query($conn, $sql_delete)) {
         echo "Record deleted successfully";
    } else {
         echo "Error deleting record: " . mysqli_error($conn);
    }
    }

// $sql = "INSERT INTO course (code,course_name,course_type,instructor_id,date_time) VALUES ('COE3167930','Physics','Mandatory',6,'2021/01/12 02:53')";

// if (mysqli_query($conn, $sql)) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

$sql = "SELECT course.id,course.code,course.course_name,course.course_type,course.instructor_id,course.date_time,user.fname,user.lname FROM course,user WHERE user.id=course.instructor_id";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $data_id = $row['id'];
    echo "<tr>" . 
    "<td>" . $row['code']. "</td>" . 
    "<td>" . $row['course_name']. "</td>" . 
    "<td>" . $row['course_type']. "</td>" . 
    "<td>" . $row['fname']." " . $row['lname'] ."</td>" . 
    "<td>" . $row['date_time']. "</td>" .
    "<td>" . "<a onclick=\"delete_data($data_id)\" href=\"#course\">" . "<i class=\"fas fa-trash-alt\">" . "</i>" .  "</a>" . "</td>" . "</tr>";
  }
  echo "</tbody>" . "</table>";
} else {
  echo "0 results";
}

if(isset($_POST['create_course_button'])){
	$cc_course_code = $_POST['course_code'];
	$cc_course_name = $_POST['cname'];
	$cc_course_type = $_POST['course_type'];
	$cc_course_datetime = $_POST['date'];
  $cc_course_instructor_id = $instructor_id;

	if($cc_course_code != " " || $cc_course_name != " "){
    $query = "INSERT INTO course (code,course_name,course_type,instructor_id,date_time) VALUES (?,?,?,?,?)";
    $statement = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($statement,'sssis',$cc_course_code,$cc_course_name,$cc_course_type,$cc_course_instructor_id,$cc_course_datetime);
    mysqli_stmt_execute($statement);
    print(mysqli_stmt_error($statement) . "\n");
    mysqli_stmt_close($statement);
    $message = "Course was created succesfully!";
    echo "<script type='text/javascript'>alert('$message');</script>"; 
  }
  else{
    $message = "Course name or code cannot be empty!";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}
 

mysqli_close($conn);

    ?>

 

</body>
</html>