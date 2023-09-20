<?php
    include ('dbconnect.php');
    
      
    
if ($_GET['submit'])
    {
	$id = $_GET['id'];
	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	$email = $_GET['email'];
	$phoneno = $_GET['phoneno'];
	$password = $_GET['password'];
    $filename = $_GET['filename'];



    $result = mysqli_query($conn,"UPDATE customer SET firstname ='$fname', lastname ='$name', email ='$email' , phoneno ='$phoneno' ,password ='$password', filename ='$filename' WHERE id = '$id'");
 	
 	$data=mysqli_query($con, $sql);
   	
 	if ($data) {
 		//echo "record update";
 		header('location:display.php');
 	}
 	else{
 		echo "not update";
 	}
}
else
{
	echo "click on  button to save the change";
}

    
?>
<form id="form" class="form" method='post' action='formSubmit.php' enctype='multipart/form-data'>
        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
        <label for="firstname">First Name:</label>
        <input type="text" name="fname" class="firstname" id="fname" value="<? echo $firstname; ?>" placeholder="enter your name" >
        <label for="lastname">Last Name:</label>
        <input type="text" name="lname" class="lastname" id="lname"  value="<? echo $lastname; ?>"placeholder="enter your surname" >
        <label for="email">Email Id:</label>
        <input type="gmail" name="email" class="email" id="email"  value="<? echo $email; ?>"placeholder="enter your gmail" >
        <lable for ="phoneno">phoneno</lable>
        <input type="tel" name="phoneno" class="phoneno" id="phoneno" value="<? echo $phoneno; ?>"placeholder="enter your phone number" >
        <lable for ="password">password</lable>
        <input type ="password" name="password" class="password" id="password"  value="<? echo $password; ?>"placeholder="enter your password"></input>
        <input type="file" name="file" class="file" id="file"  value="<? echo $filename; ?>"multiple="multiple" />
        <button type="submit" name="update">update</button>
    </form>
