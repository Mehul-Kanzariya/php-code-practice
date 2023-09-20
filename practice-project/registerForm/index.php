<?php
include('connection.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // echo $id;
    $query = "SELECT persInfo.fname,persInfo.lname,addrInfo.addDropdown,addrInfo.company,addrInfo.phoneNo,addrInfo.streetAdd,addrInfo.postalCode,addrInfo.country,addrInfo.state,addrInfo.city,signInfo.email,signInfo.password
    FROM persInfo
    JOIN addrInfo ON  persInfo.regId = addrInfo.regId
    JOIN signInfo ON  persInfo.regId = signInfo.regId WHERE persInfo.regId = $id";
    $raw = mysqli_query($conn, $query);
    // echo $raw;
    $count = mysqli_num_rows($raw);
    if ($count == 1) {
        $number = mysqli_fetch_assoc($raw);
        $fname = $number["fname"];
        $lname = $number["lname"];
        $addDropdown = $number["addDropdown"];
        $company = $number["company"];
        $phoneNo = $number["phoneNo"];
        $streetAdd = $number["streetAdd"];
        $postalCode = $number["postalCode"];
        $country = $number["country"];
        $state = $number["state"];
        $city = $number["city"];
        $email = $number["email"];
        $password = $number["password"];
    }
} else {
    $id = '';
    $fname = '';
    $lname = '';
    $addDropdown = '';
    $company = '';      
    $phoneNo = '';
    $streetAdd = '';
    $postalCode = '';
    $country = 'select country';
    $state = 'Select State';
    $city = 'Select City';
    $email = '';
    $password = '';
}
// echo $state;
// echo $addDropdown;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="register.js"></script>
    <title>Registration Form</title>
</head>
<style>
    .required:after {
    content:" *";
    color: red;
    } 
</style>
<body>
<div class="header-section">
    <div class="container">
        <h2>Create new customer account</h2>    
        <div class="register-form">
            <form class="form" id="form" method="post">
                <div class="persInfo-section">
                    <h3>Personal Information</h3>
                    <div class="inputId">
                        <input type="hidden" class="id" name="id" id="id" value="<?php echo $id; ?>">
                    </div>
                    <div class="firstName">
                        <label for="firstName" class="required">First Name:</label>
                        <input type="text" name="fname" class="form-control fname" id="fname" value="<?php echo $fname; ?>">
                        <div id="fname-error-message" style="color: red; display: none;">Special characters are not allowed in the first name field.</div>
                    </div>
                    <div class="lastName">
                        <label for="lastName" class="required">Last Name:</label>
                        <input type="text" name="lname" class="form-control lname" id="lname" value="<?php echo $lname; ?>">
                        <div id="lname-error-message" style="color: red; display: none;">Special characters are not allowed in the last name field.</div>
                    </div>
                </div>
                <div class="address-section">
                    <h3>Address Information</h3>
                    <div class="addressDropdown">
                        <label for="addressType" class="required">Address type:</label>
                        <select class="form-control addressType" name="addDropdown" id="addDropdown">        
                            <option value="residential" <?php if ($addDropdown =="residential"){echo 'selected="selected"';} ?>>residential</option>
                            <option value="commercial" <?php if ($addDropdown =="commercial"){echo 'selected="selected"';} ?>>commercial</option>
                        </select>
                    </div>
                    <div id="companyField">
                        <label for="company" class="required">Company:</label>
                        <input type="text" name="company" class="form-control company" id="company" value="<?php echo $company; ?>">
                        <span class="error resiError" id="companyError"></span>
                    </div>
                    <div class="phoneNumber">
                        <label for="phoneNo" class="required">Phone No:</label>
                        <input type="text" name="phoneNo" class="form-control phoneNo" id="phoneNo" value="<?php echo $phoneNo; ?>">
                        <span class="error" id="phoneNoError"></span>
                    </div>
                    <div class="streetAddress">
                        <label for="streetAdd" class="required">Street Address:</label>
                        <input type="textarea" name="streetAdd" class="form-control streetAdd" id="streetAdd" value="<?php echo $streetAdd; ?>">
                    </div>
                    <div class="pincode">
                        <label for="postalCode" class="required">Postal code:</label>
                        <input type="text" name="postalCode" class="form-control postalCode" id="postalCode" value="<?php echo $postalCode; ?>">
                    </div>
                    <div class="depended-dd">
                        <?php
                        $query = "SELECT * FROM countries";
                        // echo $query;
                        $run_query = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($run_query);
                        // echo $count;
                        ?>
                        <label for="country" class="required">country:</label>
                        <select  class="form-control" name="country" id="country">
                            <option value="">Select Country</option>
                            <?php
                            if($count > 0){
                                while($row = mysqli_fetch_array($run_query)){
                                    $country_id = $row['country_id'];
                                    $country_name = $row['country_name']; 
                                    $selected = '';
                                    if ($country == $country_id) {
                                        $selected = 'selected'; 
                                    }
                                    echo '<option value="' . $country_id . '" ' . $selected . '>' . $country_name . '</option>';
                                } 
                            }else{
                                echo '<option value="">Country not available</option>';
                            }
                            ?>
                        </select>
                        <?php
                        $query = "SELECT * FROM states WHERE country_id = '$country'";
                        // echo $query;
                        $run_query = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($run_query);
                        // echo $count;
                        ?>
                        <label for="state" class="required">state:</label>   
                        <select  class="form-control" name="state" id="state">
                            <option value="">Select State</option>
                            <?php
                            if($count > 0){
                                while($row = mysqli_fetch_array($run_query)){
                                    $state_id = $row['state_id'];
                                    $state_name = $row['state_name']; 
                                    $selected = '';
                                    if ($state == $state_id) {
                                        $selected = 'selected'; 
                                    }
                                    echo '<option value="' . $state_id . '" ' . $selected . '>' . $state_name . '</option>';
                                } 
                            }else{
                                echo '<option value="">state not available</option>';
                            }
                            ?>
                        </select>
                        <?php
                        $query = "SELECT * FROM cities WHERE state_id = '$state'";
                        // echo $query;
                        $run_query = mysqli_query($conn, $query);
                        $count = mysqli_num_rows($run_query);
                        // echo $count;
                        ?>
                        <label for="city" class="required">City:</label>   
                        <select  class="form-control" name="city" id="city">
                            <option value="">Select City</option>
                            <?php
                            if($count > 0){
                                while($row = mysqli_fetch_array($run_query)){
                                    $city_id = $row['city_id'];
                                    $city_name = $row['city_name']; 
                                    $selected = '';
                                    if ($city == $city_id) {
                                        $selected = 'selected'; 
                                    }
                                    echo '<option value="' . $city_id . '" ' . $selected . '>' . $city_name . '</option>';
                                } 
                            }else{
                                echo '<option value="">city not available</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="sign-section">
                    <h3>Sign-in information</h3>
                    <div class="emailId">
                        <label for="email" class="required">Email:</label>
                        <input type="email" name="email" class="form-control email" id="email" value="<?php echo $email; ?>">
                        <span class="error" id="emailError"></span>
                    </div>
                    <div class="formPassword">
                        <label for="password" class="required">Password:</label>
                        <input type="password" name="password" class="form-control password" id="password" value="<?php echo $password; ?>">
                    </div>
                    <div class="confirmPassword">
                        <label for="cpassword" class="required">Confirm password:</label>
                        <input type="cpassword" name="cpassword" class="form-control cpassword" id="cpassword" placeholder="Confirm your password">
                        <span class="error" id="passwordError"></span>
                    </div>
                </div>
                <div class="submit-button">
                    <input type="button" name="submit" class="btn btn-primary" value="Submit" id="butsubmit">
                    <!-- <button id="deleteRecord" class="btn btn-primary">Delete</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>