function validation() {
    var firstName =document.forms["form"]["fname"].value;
    var lastName =document.forms["form"]["lname"].value;
    var emailId =document.forms["form"]["email"].value;
    var phoneNo =document.forms["form"]["phoneno"].value;
    var cityName =document.forms["form"]["city"].value;
    var Cmnt =document.forms["form"]["comment"].value;
    var specialChars = /[^a-zA-Z]/g;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var cellNo = /^(?:\(\d{3}\)|\d{3}-)\d{3}-\d{4}$/;
    if ((firstName == "")  || (firstName.match(specialChars))) {
        alert("Please enter your valid first name.");
        fname.focus();
        return false;
    }else if ((lastName == "")  || (lastName.match(specialChars))) {
        alert("Please enter your valid lastname.");
        lname.focus();
        return false;
    }else if ((emailId == "") || (!emailId.match(mailformat))) {
        alert("Please enter valid e-mail address.");
        email.focus();
        return false;
    }else if((phoneNo == "") || (!phoneNo.match(cellNo))) {
        alert("enter valid phoneno");
        phoneno.focus();
        return false;
    }else if( cityName== "" ) {
        alert("select city");
        city.focus();
        return false;
    }else if(Cmnt == "") {
        alert("add comment plzz");
        comment.focus();
        return false;
    }
    
 }
function addHyphen (element) {
    let ele = document.getElementById(element.id);
    ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.
    let finalVal = ele.replace(/(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)/, '$1$2$3-$4$5$6-$7$8$9$10')
    document.getElementById(element.id).value = finalVal;
}
