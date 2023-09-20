$(document).ready(function(){
    $('#butsubmit').on('click', function() {
        // alert ("sure?");
        var id = $('#id').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var addDropdown = $('#addDropdown').val();
        var company = $('#company').val();
        var phoneNo = $('#phoneNo').val();
        var streetAdd = $('#streetAdd').val();
        var postalCode = $('#postalCode').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        // var cpassword = $('#password').val();
        var fnameRegex = /^[a-zA-Z\s]*$/;
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        
        if ((addDropdown === "commercial") && (company === "")){
            $("#companyError").text("Enter your company name").css("color","red");
            $("#company").focus();
            $("#company").keyup(function(){
                $(".error").text("");
            });
            return;
        }
        if ((addDropdown === "residential") && (company != "")){
            // $(".company").val("");
            $("#companyField").show();
            $(".resiError").text("Please Remove Company Name.").css("color","red");
            $("#company").focus();
            $("#company").keyup(function(){
                $(".error").text("");
            });
            return false;
        }
        if (!fname.match(fnameRegex)) {
            // alert ("fname");
            $("#fname").focus();
            return false;
        } else if (!lname.match(fnameRegex)) {
            // alert ("lname");
            $("#lname").focus();
            return false;
        } else if ((email == "") || (!email.match(mailformat))) {
            $("#emailError").text("Please enter a valid email address.").css("color","red");
            $("#email").focus();
            $("#email").keyup(function(){
                $(".error").text("");
            });
            return false;
        }else if (password !== cpassword){
            $("#passwordError").text("Password Does Not Match with confirm password.").css("color","red");
            $("#password").focus();
            $("#cpassword").keyup(function(){
                $(".error").text("");
            });
            return false;
        }else if (phoneNo == "") {
            $("#phoneNoError").text("Please Enter Your Phone Number.").css("color","red");
            $("#phoneNo").focus();
            $("#phoneNo").keyup(function(){
                $(".error").text("");
            });
            return false;
        } else if (fname!="" && lname!="" && phoneNo!="" && postalCode!="" && country!="" && state!="" && city!=""  && email!="" && password!=""){
            // alert ("data insert/update successfully");
            window.location.replace("displayData.php");
            $.ajax({
                url: "saveData.php",
                type: "POST", 
                data: {
                    id: id,
                    fname: fname,
                    lname: lname,
                    addDropdown: addDropdown,
                    company: company,
                    phoneNo: phoneNo,
                    streetAdd: streetAdd,
                    postalCode: postalCode,
                    country: country,
                    state: state,
                    city: city,
                    email: email,
                    password: password				
                },
                cache: false,
                success: function(dataResult){
                    console.log (dataResult); 
                    // var dataResult = JSON.parse(dataResult);
                    // console.log(dataResult);
                    if(dataResult.statusCode == 200){
                        // alert ("data stauscode is 200");
                        //    $('#form').find('input:text').val('');
                        $.ajax({
                            url: "displayData.php",
                            type: "POST",
                            cache: false,
                            success: function(data){
                                $('#table').html(data);
                            }
                        }); 						
                    }   
                    else if(dataResult.statusCode == 201){
                        alert("Error occured !");
                    }
                }
            });
            // console.log(id);
            // console.log(fname);
            // console.log(email);
            // console.log(phoneNo);
            // console.log(country);
            // console.log(state);
            // console.log(addDropdown);
        } else {
            alert('Please fill all the field !');
        }
            // console.log(id);
    });

    $('#fname').on('input', function() {
        var fname = $(this).val();
        // console.log(fname);
        var fnameRegex = /^[a-zA-Z\s]*$/;
        if (!fnameRegex.test(fname)) {
            $('#fname-error-message').show();
            return false;
        } else {
            $('#fname-error-message').hide();
        }
    });

    $('#lname').on('input', function() {
        var lname = $(this).val();
        var lnameRegex = /^[a-zA-Z\s]*$/;
        if (!lnameRegex.test(lname)) {
            $('#lname-error-message').show();
        } else {
            $('#lname-error-message').hide();
        }
    });

    $("#phoneNo").on("input", function() {
        var phoneNumber = $(this).val().replace(/\D/g, '');
        if (phoneNumber.length > 10) {
            phoneNumber = phoneNumber.slice(0, 10);
        }
        $(this).val(phoneNumber);
    });

    $('#country').on('change',function(){
    var countryID = $(this).val();
    // console.log (countryID);
    if (countryID) {
        $.ajax({
            type:'POST',
            url:'ajaxDropdown.php',
            data:'country_id='+countryID,
            success:function(html){
                $('#state').html(html);
                $('#city').html('<option value="">Select state first</option>'); 
            }
        }); 
        // console.log(countryID);
    } else {
        $('#state').html('<option value="">Select country first</option>');
        $('#city').html('<option value="">Select state first</option>'); 
    }
    });
    
    $('#state').on('change',function() {
        var stateID = $(this).val();
        // console.log(stateID);
        if (stateID) {
            $.ajax({
                type:'POST',
                url:'ajaxDropdown.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        } else {
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
        
    $(document).on("click", "#deleteRecord",function() { 
        var result = confirm("Want to delete this data?");
        if (result) {
         // alert ("delete data");
        //  $(this).parents("tr").css('color', 'red');
        var ele = $(this).parents("tr");
        // $(ele).css('color', 'red');
        // alert("Are you sure to delete id :" + $(this).parents("tr").children(".formId").text());
        $.ajax({
            url: "deleteData.php",
            type: "POST",
            cache: false,
            data:{
                id: $(this).parents("tr").children(".formId").text()
                },
            	success: function(dataResult) {
                    // console.log(dataResult);
                    var data = JSON.parse(dataResult);
                    // console.log(data);
                   if(data.statusCode == 200){
                    // alert ("data is deleted successfully");
                       ele.remove();
                   }
                // console.log(dataResult.statusCode == 200);
            }
        });
        // console.log($(this).parents("tr").children(".formId").text());
    }
    });

    var id = $('#id').val();
    var addDropdown = $('#addDropdown').val();
    if ((id != "") && (addDropdown === "commercial")){
        $("#companyField").show();
    } else {
        $("#companyField").hide();
    } 

    $("#addDropdown").change(function() {
    var addressType = $(this).val();
    if (addressType === "commercial") {
        $("#companyField").show();
    } else {
        $("#companyField").hide();
    }
    });
});