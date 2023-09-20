<?php
include 'database.php';
$sql = "SELECT * FROM user_data";
$result = $conn->query($sql);
$total = mysqli_num_rows($result);
if ($total != 0) {
	while ($row = mysqli_fetch_assoc($result)) {
?>	
	<tr>
		<td class="formId" style="border: 1px solid black;"><?= $row['id']; ?></td>
		<td class="name" style="border: 1px solid black;"><?= $row['name']; ?></td>
		<td class="email" style="border: 1px solid black;"><?= $row['email']; ?></td>
		<td class="phone" style="border: 1px solid black;"><?= $row['phone']; ?></td>
		<td class="country" style="border: 1px solid black;"><?= $row['country']; ?></td>
		<td class="state" style="border: 1px solid black;"><?= $row['state']; ?></td>
		<td class="city" style="border: 1px solid black;"><?= $row['city']; ?></td>
		<td style="border: 1px solid black;">
		<a class="update-btn" style="border: 1px solid black;padding: 4px;margin:0px 10px;" href="index.php?id=<?=$row['id']?>">update</a>
		<button class="delete-btn btn-danger">Delete</button>
		<!-- <button class="update-btn">Update</button> -->
		</td>
	</tr>
<?php
	}
	} else {
		echo "NO RECORD INSERTED";
	}
	mysqli_close($conn);
?>