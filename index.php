<?php

include('dbconnect.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM customer WHERE id='$id'";
    $raw = mysqli_query($conn, $query);
    $count = mysqli_num_rows($raw);
    if ($count == 1) {
        $number = mysqli_fetch_assoc($raw);
        $firstname = $number["firstname"];
        $lastname = $number["lastname"];
        $email = $number["email"];
        $phoneno = $number["phoneno"];
        $password = $number["password"];
        $filename = $number["filename"];
    } else {
        echo "Error";
    }
} else {

    $firstname = '';
    $lastname = '';
    $email = '';
    $phoneno = '';
    $password = '';
    $filename = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <form id="form" class="form" method="post" action="formSubmit.php" enctype="multipart/form-data">
        <input type="hidden" name="id" class="id" value="<?php 
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            } echo $id; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" name="fname" class="firstname" id="fname" value="<?php echo $firstname; ?>">
        <label for="lastname">Last Name:</label>
        <input type="text" name="lname" class="lastname" id="lname" value="<?php echo $lastname; ?>">
        <label for="email">Email Id:</label>
        <input type="gmail" name="email" class="email" id="email" value="<?php echo $email; ?>">
        <lable for="phoneno">phoneno</lable>
        <input type="tel" name="phoneno" class="phoneno" id="phoneno" value="<?php echo $phoneno; ?>">
        <lable for="password">password</lable>
        <input type="password" name="password" class="password" id="password" value="<?php echo $password; ?>">
        <input type="file" name="file" class="file" id="file" value="<?php echo $filename; ?>" multiple="multiple" />
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>