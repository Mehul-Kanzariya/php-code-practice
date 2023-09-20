<?php
header("Location:display.php");
include "dbconnect.php";
$tableName = "customer";
$tableExists = false;
$result = $conn->query("SHOW TABLES LIKE '$tableName'");
if ($result->num_rows > 0) {
 $tableExists = true;
}

if (!$tableExists) {
$sql = "CREATE TABLE $tableName (
  id INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(55) NOT NULL,
  lastname VARCHAR(55) NOT NULL,
  email VARCHAR(50),
  phoneno VARCHAR(10) NOT NULL,
  password VARCHAR(50) NOT NULL,
  filename VARCHAR(50) NOT NULL)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
} else {
    echo "Table created successfully!";
}
} else {
echo "Table already exists ";
}

if(isset($_POST['submit'])){ 
  $id = $_POST['id'];

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST ["email"];
  $phoneno = $_POST ["phoneno"];
  $password = $_POST ["password"];
  $filename = $_FILES["file"]["name"];

      $query = "SELECT * FROM customer WHERE id='$id'"; 
        $raw = mysqli_query($conn,$query);
        $count = mysqli_num_rows($raw);

  if ($count == 0){
     
      $id = $_POST['id'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname']; 
      $email = $_POST ["email"];
      $phoneno = $_POST ["phoneno"];
      $password = $_POST ["password"];
      $filename = $_FILES["file"]["name"];
      
      $tempname = $_FILES["file"]["tmp_name"];
      $folder = "uploads/" . $filename;
      move_uploaded_file($tempname, $folder); 
      
      $sql = "INSERT INTO $tableName (firstname,lastname,email,phoneno,password,fileName)
      VALUES ('$fname','$lname','$email','$phoneno','$password','$filename')";
      if ($conn->query($sql) === TRUE) {
        echo "<h3> New record created successfully!</h3>  ";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  } else {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST ["email"];
        $phoneno = $_POST ["phoneno"];
        $password = $_POST ["password"];
        $filename = $_FILES["file"]["name"];
      
        $result = mysqli_query($conn,"UPDATE customer SET firstname ='$fname', lastname ='$lname', email ='$email' , phoneno ='$phoneno' ,password ='$password', filename ='$filename' WHERE id = '$id'");
        
        if ($result) {
            echo "updated";

        } else {
            echo "NO UPDATE RECORD";
        } 
      }
    }
