<?php
include 'connection.php';
	$id = $_POST['id'];
	// echo $id;
	$sql ="DELETE persInfo,addrInfo,signInfo
	FROM persInfo
	JOIN addrInfo ON persInfo.regId = addrInfo.regId
	JOIN signInfo ON persInfo.regId = signInfo.regId
	WHERE persInfo.regId = $id";

	// if (mysqli_query($conn, $sql)){
	// 	echo "join success";
	// }
	// echo $sql;
	// $delete = "DELETE FROM signInfo WHERE regId = '$id'";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));	
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	
mysqli_close($conn);
?>