$(document).ready(function() {
    $('#butsave').on('click', function() {
    var id = $('#id').val();
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var country = $('#country').val();
    var state = $('#state').val();
    var city = $('#city').val();

        if (name!="" && email!="" && phone!="" && country!="" && state!="" && city!=""){
            $.ajax({
                url: "save.php",
                type: "POST", 
                data: {
                    id: id,
                    name: name,
                    email: email,
                    phone: phone,
                    country: country,
                    state: state,
                    city: city				
                },
                cache: false,
                success: function(dataResult){
                 console.log (dataResult); 
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if(dataResult.statusCode == 200){
                        // alert ("data stauscode is 200");
                       $('#fupForm').find('input:text').val('');
                        $.ajax({
                            url: "view.php",
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
            // console.log(name);
            // console.log(email);
            // console.log(phone);
            // console.log(country);
            // console.log(state);
            // console.log(city);
        } 
        else {
            alert('Please fill all the field !');
        }
    });

    $(document).on("click", ".delete-btn", function() { 
        //  $(this).parents("tr").css('color', 'red');
		var ele = $(this).parents("tr");
        // $(ele).css('color', 'red');
        // alert("Are you sure to delete id :" + $(this).parents("tr").children(".formId").text());
		$.ajax({
			url: "delete.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).parents("tr").children(".formId").text()
			    },
			success: function(dataResult){
                console.log(dataResult);
                 var data = JSON.parse(dataResult);
                console.log(data);
				if(data.statusCode == 200){
					ele.remove();
				}
                // console.log(dataResult.statusCode == 200);
			}
		});
	});

    $('#country').on('change',function(){
        var countryID = $(this).val();
        // console.log (countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        // console.log(stateID);
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxFile.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});