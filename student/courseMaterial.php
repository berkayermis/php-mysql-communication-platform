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
        <a href="student.php#course"><img class="icon-logo-width" src="../icons/school-logo.png" alt=""></a> <hr>
        <a href="student.php#profile"><i class="far fa-user"></i></a>
        <div class="dropdown">
          <a href="student.php#course"><i class="fas fa-book"></i></a>
          <div class="dropdown-content">
          <a href="student.php#course">Courses</a>
          <a href="student.php#taken-course">Taken Courses</a>
          </div>
        </div>
        <a href="student.php#research"><img class="icon-width" src="../icons/add-research.png" alt=""></a>
        <a href="student.php#message"><i class="far fa-envelope"></i></a>
        <a href="../main/index.php"><i class="fas fa-sign-out-alt"></i></a>
    </nav>

    <div id="id01" class="">
          <div>
            <span onclick="location.href ='student.php#taken-course'" class="close" title="Close Modal">&times;</span>            
            <table>
              <thead>
              <tr>
                <th>File Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Size</th>
                <th>Options</th>
              </tr>
            </thead>
            <?php
                require_once('../config.php');
                  
                $conn = mysqli_connect($servername, $username, $password,$db);
            
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                $sql = 'SELECT coursematerial.id,coursematerial.file_name,coursematerial.material_description, coursematerial.material,coursematerial.course_id FROM coursematerial
                WHERE coursematerial.course_id = "'.$_GET['info'].'"';

                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $data = $row['file_name'];
                        // echo date("F d Y", filemtime('../files/all-courses.pdf'));
                        echo "<td>" . $data . "</td>" . 
                        "<td>" . $row['material_description'] . "</td>" . 
                        "<td>" . date ("F d Y", filemtime('../files/'.$data)) . "</td>" . 
                        "<td>" . filesize('../files/'.$data)/1000 ."B" . "</td>". 
                        "<td>" . "<a style='color: black;' href='../files/$data' download>" . "<i class='fas fa-file-download'>" . "</i>" . "</a>" . "</td>" .
                        "</tr>";
                    }
                }
            ?>
              <!-- <tr>
                <td>homework 4 solution_21122018-merged.pdf</td>
                <td>Homework 4 solution	</td>
                <td>22.12.2018	</td>
                <td>2,0 MB</td>
                <td><a style="color: black;" href="../files/COE3167880_Syllabus_Fall_2018.pdf" download><i class="fas fa-file-download"></i></a></td>
              </tr>
              <tr>
                <td>MidtermII_Exam_Places.pdf	</td>
                <td>Midterm II Exam Places-23.12.2018	</td>
                <td>21.12.2018</td>
                <td>140 KB</td>
                <td><a style="color: black;" href="../files/COE3167880_Syllabus_Fall_2018.pdf" download><i class="fas fa-file-download"></i></a></td>
              </tr>
              <tr>
                <td>Midterm1 2 Results.pdf</td>
                <td>-</td>
                <td>67</td>
                <td>22.1.2019</td>
                <td><a style="color: black;" href="../files/COE3167880_Syllabus_Fall_2018.pdf" download><i class="fas fa-file-download"></i></a></td>
              </tr> -->
            </table>  
          </div>
        </div>
    
</body>
</html>

