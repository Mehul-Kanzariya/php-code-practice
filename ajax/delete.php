<?php
include 'database.php';
	$id = $_POST['id'];
	$sql = "DELETE FROM user_data WHERE id=$id";
	// $query = mysqli_query($conn, $sql);
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

mysqli_close($conn);
?>