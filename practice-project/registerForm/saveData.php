<?php
include 'connection.php';
$regId =  $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$addDropdown = $_POST['addDropdown'];
$company = $_POST['company'];
$phoneNo = $_POST['phoneNo'];
$streetAdd = $_POST['streetAdd'];
$postalCode = $_POST['postalCode'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$email = $_POST['email'];
$password = $_POST['password'];
$encrypted_pwd = md5($password);
// $country = $_POST['country'];
// $state = $_POST['state'];
// $city = $_POST['city'];
echo $regId;
// echo $name;
// echo $email;
// echo $phone;
// echo $country;
// echo $state;
// echo $city;

$tableName = "persInfo";
$tableExists = false;
$result = $conn->query("SHOW TABLES LIKE '$tableName'");
if ($result->num_rows > 0) {
	$tableExists = true;
}

if (!$tableExists) {
  $sql = "CREATE TABLE $tableName (
    regId INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(55) NOT NULL,
    lname VARCHAR(55) NOT NULL)";
	if ($conn->query($sql) === false) {
		echo "Error creating table: " . $conn->error;
	} else {
		echo "Table created successfully!";
	}
} else {
	echo "personal info Table already exists ";
}

$addtable = "addrInfo";
$tableExists2 = false;
$result = $conn->query("SHOW TABLES LIKE '$addtable'");
if ($result->num_rows > 0) {
	$tableExists2 = true;
}
if (!$tableExists2) {
	$sql = "CREATE TABLE $addtable (
		addId INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
		regId INTEGER(10) NOT NULL,
		addDropdown VARCHAR(55) NOT NULL,
		company VARCHAR(50),
		phoneNo VARCHAR(10) NOT NULL,
		streetAdd VARCHAR(50) NOT NULL,
		postalCode VARCHAR(10) NOT NULL,
		country VARCHAR(50) NOT NULL,
		state VARCHAR(50) NOT NULL,
		city VARCHAR(50) NOT NULL
		-- FOREIGN KEY (regID) REFERENCES persInfo(regId)
		)";
	if ($conn->query($sql) === false) {
		echo "Error creating table: " . $conn->error;
	} else {
		echo "address Table created successfully!";
	}
	
} else {
	echo " address Table already exists ";
}


$signtable = "signInfo";
$tableExists3 = false;
$result = $conn->query("SHOW TABLES LIKE '$signtable'");
if ($result->num_rows > 0) {
	$tableExists3 = true;
}
if (!$tableExists3) {
	$sql = "CREATE TABLE $signtable (
		signId INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
		regId INTEGER(10) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password VARCHAR(50) NOT NULL
		-- FOREIGN KEY (regID) REFERENCES addrInfo(regId)
		)";
	
	if ($conn->query($sql) === false) {
		echo "Error creating table: " . $conn->error;
	} else {
		echo "sign in Table created successfully!";
	}
} else {
	echo " sign in Table already exists ";
}



if ($regId == '') {
	// $join = "SELECT persInfo.regId,persInfo.fname,persInfo.lname,addrInfo.addDropdown,addrInfo.company,addrInfo.phoneNo,addrInfo.streetAdd,addrInfo.postalCode,addrInfo.country,addrInfo.state,addrInfo.city,signInfo.email,signInfo.password
    // FROM persInfo
    // INNER JOIN addrInfo ON persInfo.regId = addrInfo.regId
    // INNER JOIN signInfo ON persInfo.regId = signInfo.regId";
	// $run_join = $conn->query($join);
	
	
	// $inserData = "SELECT persInfo.regId,addrInfo.regId,signInfo.regId
	// 	FROM ((persInfo
	// 	INNER JOIN addrInfo ON persInfo.regId = addrInfo.regId)
	// 	INNER JOIN signInfo ON persInfo.regId = signInfo.regId)";
	// 	if (mysqli_query($conn,$inserData)) {
	// 		echo "data inserted successfully";
	// 	}

	$query = "INSERT INTO `persInfo` (`fname`,`lname`) VALUES ('$fname','$lname')";
	if (mysqli_query($conn,$query)){
		echo "personal info data inserted";
	};
	
	// $innData = "INSERT INTO addrInfo (regId)
    // SELECT persInfo.regId 
    // FROM persInfo
    // WHERE regId = persInfo.regId";
	// if (mysqli_query($conn,$innData)){
	// 	echo "query run";
	// };
	$addQuery = "INSERT INTO `addrInfo` (`regId`,`addDropdown`,`company`,`phoneNo`,`streetAdd`,`postalCode`,`country`,`state`,`city`) VALUES (LAST_INSERT_ID(),'$addDropdown', '$company','$phoneNo','$streetAdd','$postalCode','$country','$state','$city')";
	if (mysqli_query($conn, $addQuery)) {
		echo "address data inserted ";
	};	

	$signQuery = "INSERT INTO `signInfo` (`regId`,`email`,`password`) VALUES (LAST_INSERT_ID(),'$email','$encrypted_pwd')";
	if (mysqli_query($conn, $signQuery)) {
		echo "sign in data inserted";
	};
	
} else {
	$raw = mysqli_query($conn,"SELECT * FROM persInfo WHERE regId ='$regId'");
	$count = mysqli_num_rows($raw);
	echo $count;
	if($count > 0){
		$updateData ="UPDATE persInfo
		JOIN addrInfo ON persInfo.regId = addrInfo.regId
		JOIN signInfo ON persInfo.regId = signInfo.regId
		SET persInfo.fname = '$fname',
			persInfo.lname = '$lname',
			addrInfo.addDropdown = '$addDropdown',
			addrInfo.company = '$company',
			addrInfo.phoneNo = '$phoneNo',
			addrInfo.streetAdd = '$streetAdd',
			addrInfo.postalCode = '$postalCode',
			addrInfo.country = '$country',
			addrInfo.state = '$state',
			addrInfo.city = '$city',
			signInfo.email = '$email',
			signInfo.password = '$encrypted_pwd'
		WHERE persInfo.regId = $regId";
		echo $updateData;
		if(mysqli_query($conn, $updateData)) {
			// echo json_encode(array("statusCode"=>200));
			echo "data updates";
		} 
		else {
			echo json_encode(array("statusCode"=>201));
		}
	}
}

mysqli_close($conn);
?>