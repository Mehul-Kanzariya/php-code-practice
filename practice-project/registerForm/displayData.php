<html>
<head>
    <title>display data</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="register.js"></script>
</head>
<style>
    table {
        border-collapse: collapse;
        border: 2px solid black;
    }

    th,
    td {
        border: 1px solid black;
    }
</style>
<body>
    <table>
		<tbody id="table">
			<tr>
				<th>regId</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Address Type</th>
				<th>company</th> 
				<th>phoneNo</th>
				<th>streetAdd</th>
				<th>postalCode</th>
				<th>country</th>
				<th>state</th>
				<th>city</th>
				<th>email</th>
				<th>password</th>
				<th>update</th>
				<!-- <th>delete</th> -->
			</tr>
		</tbody>
			<?php

				include 'connection.php';
				$sql = "SELECT persInfo.regId,persInfo.fname,persInfo.lname,addrInfo.addDropdown,addrInfo.company,addrInfo.phoneNo,addrInfo.streetAdd,addrInfo.postalCode,addrInfo.country,addrInfo.state,addrInfo.city,signInfo.email,signInfo.password
				FROM persInfo
				INNER JOIN signInfo ON persInfo.regId = signInfo.regId
				INNER JOIN addrInfo ON addrInfo.regId = persInfo.regId";
				// echo $sql;
				$result = $conn->query($sql);
				$total = mysqli_num_rows($result);
				// echo $total;
				
				if ($total != 0 ) {
					while ($row = mysqli_fetch_assoc($result))  {
						// echo $row;
			?>	
			<tr>
				<td class="formId" ><?= $row['regId']; ?></td>
				<td class="fname"><?= $row['fname']; ?></td>
				<td class="lname"><?= $row['lname']; ?></td>
				<td class="company"><?= $row['addDropdown']; ?></td>
				<td class="company"><?= $row['company']; ?></td>
				<td class="phoneNo"><?= $row['phoneNo']; ?></td>
				<td class="streetAdd"><?= $row['streetAdd']; ?></td>
				<td class="postalCode"><?= $row['postalCode']; ?></td>
				<td class="country"><?= $row['country']; ?></td>
				<td class="state"><?= $row['state']; ?></td>
				<td class="city"><?= $row['city']; ?></td>
				<td class="email"><?= $row['email']; ?></td>
				<td class="password"><?= $row['password'];?></td>
				<td>
					<a href="index.php?id=<?=$row['regId']?>">update</a>
					<button type="button" class="btn btn-primary" id="deleteRecord">Delete</button>
				</td>
			</tr>	
			<?php 
				}
				} else {
					echo "NO RECORD INSERTED";
				}
				mysqli_close($conn);				
			?>
<input type="button" onclick="window.location.href = '/registerForm/index.php';" value="Add Data" style="margin-bottom: 5px;background-color: light;"/>
</body>
</html>