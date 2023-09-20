<?php
header("location:display.php");
  include ('dbconnect.php');
  
  if (isset($_GET['id'])) {
       $id = $_GET['id'];
       $delete = mysqli_query($conn, "DELETE FROM customer WHERE id='$id'");
  }
?>
