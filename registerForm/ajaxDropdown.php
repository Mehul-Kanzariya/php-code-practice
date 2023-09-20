<?php

include('connection.php');

if(isset($_POST["country_id"])) {

	$country_id = $_POST['country_id'];
    $query = "SELECT * FROM states WHERE country_id = '$country_id'";
	$run_query = mysqli_query($conn, $query);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        echo '<option value="">Select state</option>';
        while($row = mysqli_fetch_array($run_query)){
		$state_id = $row['state_id'];
        // echo $state_id;
		$state_name = $row['state_name'];
        // echo $state_name;


        echo '<option value="' . $state_id . '">' . $state_name . '</option>';
        }
    } else {
        echo '<option value="">State not available</option>'; 
    }
}

if(isset($_POST["state_id"])) {
	$state_id= $_POST['state_id'];
    // echo $state_id;
    $query = "SELECT * FROM cities WHERE state_id = '$state_id'";
    $run_query = mysqli_query($conn, $query);
    $count = mysqli_num_rows($run_query);
    // echo $count;
    if($count > 0){
        echo '<option value="">Select city</option>';
        while($row = mysqli_fetch_array($run_query)){
		$city_id = $row['city_id'];
        // echo $city_id;
		$city_name = $row['city_name'];
        // echo $city_name; 
        echo '<option value="' . $city_id . '">' . $city_name . '</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>