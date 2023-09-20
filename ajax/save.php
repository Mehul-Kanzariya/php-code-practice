<?php
	include 'database.php';

	$id =  $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	// echo $id;
	// echo $name;
	// echo $email;
	// echo $phone;
	// echo $country;
	// echo $state;
	// echo $city;
if ($id == '') {
	$query = "INSERT INTO `user_data`(`name`, `email`, `phone`, `country`,`state`, `city`) 
	VALUES ('$name','$email','$phone','$country','$state','$city')";
	if (mysqli_query($conn, $query)) {	
		echo json_encode(array("statusCode"=>200));
		// echo "data ststuscode is 200";
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
} else {
	$raw = mysqli_query($conn,"SELECT * FROM user_data WHERE id = '$id'");
	$count = mysqli_num_rows($raw);
	// echo $count;
	if($count > 0){
			$sql ="UPDATE user_data SET id ='$id',name ='$name',email = '$email',phone ='$phone',country ='$country',state ='$state',city ='$city'WHERE id = $id";
			// echo $sql;
				if(mysqli_query($conn, $sql)) {
					echo json_encode(array("statusCode"=>200));
				} 
				else {
					echo json_encode(array("statusCode"=>201));
				}
			}
}
mysqli_close($conn);
?>
 