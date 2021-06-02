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

    <div id="upload_material" style="  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;">
                <span onclick="location.href ='instructor.php#course'" class="close" title="Close Modal">&times;</span>            
                <form method="post" action="x.php?code=<?php echo $_GET['info']; ?>">
                    <label for="">Description</label> <br> 
                    <input type="text" id="cname" name="desc" placeholder="Description" >
                    <label for="instructor">File</label> <br>
                    <input type="file" name="file"></input> <br>
                    <?php echo "<button onclick=\"location.href = 'x.php?code=$_GET[info]'\" class='approval-button' name=\"create_course_button\" type=\"submit\">" . "Upload" . '</button>' ?>
                    <!-- <button onclick='location.href="x.php"' name="create_course_button" type="submit">Upload</button> -->
                </form>
            </div>
    
</body>
</html>