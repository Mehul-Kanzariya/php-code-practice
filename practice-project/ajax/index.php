<?php
	include 'database.php';

	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		// echo $id;
		$query = "SELECT * FROM user_data WHERE id =$id";
		// echo $query;
		$raw = mysqli_query($conn, $query);
		$count = mysqli_num_rows($raw);
		if ($count == 1) {
			$number = mysqli_fetch_assoc($raw);
			$name = $number["name"];
			$email = $number["email"];
			$phone = $number["phone"];
			$country = $number["country"];
			$state = $number["state"];
			$city = $number["city"];
		} else {
			echo "Error";
		}
	} else {
		$id = '';
		$name = '';
		$email = '';
		$phone = '';
		$country = 'select country';
		$state = 'select state';
		$city = 'select city';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="query.js"></script>
</head>
<body>
<div class="container" style="margin-top: 30px;">
	<form id="fupForm" name="form1" method="post" action="update.php">
		<input type="hidden" class="id" id="id" name="id" value="<?php echo $id; ?>">
	
		<label for="name">Name:</label>
		<input type="text" class="form-control name" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" >

		<label for="email;">Email:</label>
		<input type="email" class="form-control email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your Email address" >

		<label for="phone">Phone:</label>
		<input type="text" class="form-control phone" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Enter your Phone number" >
		<br><br>
		<?php
			$query = "SELECT * FROM countries";
			$run_query = mysqli_query($conn, $query);
		
			$count = mysqli_num_rows($run_query);
		?>
		<select name="country" id="country">
		<option value="" ><?php echo $country; ?></option>
		<?php
			if($count > 0){
				while($row = mysqli_fetch_array($run_query)){
					$country_id = $row['country_id'];
					$country_name = $row['country_name'];
					echo "<option value='$country_id'>$country_name</option>";
				}
			}else{
				echo '<option value="">Country not available</option>';
			}
		?>
		</select><br><br>
		
		<select name="state" id="state">
			<option value=""><?php echo $state; ?></option>
		</select>
		<br><br>
		
		<select name="city" id="city">
			<option value=""><?php echo $city; ?></option>
		</select>
		<br><br>
		<input type="button" name="save" class="btn btn-primary" value="Save" id="butsave">
		<!-- <input type="button" name="update" class="btn btn-primary" value="update" id="butupdate"> -->
	</form>
</div>
</div>
<div class="container" style="margin-top: 50px;">
	<table class="table table-bordered table-sm" >
		<thead>
			<tr>
				<th style="border: 2px solid black;border-collapse:collapse;">id</th>
				<th style="border: 2px solid black;">Name</th>
				<th style="border: 2px solid black;">Email</th>
				<th style="border: 2px solid black;">Phone</th>
				<th style="border: 2px solid black;">country</th>
				<th style="border: 2px solid black;">state</th>
				<th style="border: 2px solid black;">City</th>
				<th style="border: 2px solid black;">Action</th>
			</tr>
		</thead>
		<tbody id="table">
			<script>
				$.ajax({
					url: "view.php",
					type: "POST",
					cache: false,
					success: function(data){
						$('#table').html(data); 
					}
				}); 
			</script>			
		</tbody>
  	</table>
</div>
</body>
</html>
   
		