<?php

 require_once('../config.php');
    
$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

$desc = $_POST['desc'];
$file = $_POST['file'];
$course_id = $_GET['code'];
echo "file: " . $file; echo "<br>";
echo "description: " . $desc;
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['../files/berkay_ermis.pdf']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['../files/berkay_ermis.pdf']['tmp_name']));
        
        $sql = "INSERT INTO coursematerial (course_id,'file_name',material_description,imageData)
	VALUES($course_id,berkay_ermis.pdf,$desc,$imgData)";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: instruction.php#course");
        }
    }
}
// $imgData = file_get_contents($_FILES[$file]['tmp_name']);

// $query = "INSERT INTO coursematerial (course_id,file_name,material_description,material) VALUES (?,?,?,?)";
// $statement = mysqli_prepare($conn,$query);
// mysqli_stmt_bind_param($statement,'issb',$course_id,'student list',$desc,$imgData);
// mysqli_stmt_execute($statement);
// print(mysqli_stmt_error($statement) . "\n");
// mysqli_stmt_close($statement);
// $message = "Material was added succesfully!";
// echo "<script type='text/javascript'>alert('$message');</script>"; 

// header("Location: instruction.php#course");
// exit;