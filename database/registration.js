$(document).ready(function() {
$("#signup").click(function() {
var fname = $("#firstname").val();
var lname = $("#lastname").val();
var email = $("#form-create-email").val();
var username = $("#form-create-username").val();
var password = $("#form-create-password").val();
var cpassword = $("#form-create-password2").val();
if (fname == '' ||lname ==''|| username=='' || email == '' || password == '' || cpassword == '') {
alert("Some fields are missing");
} else if ((password.length) < 8) {
alert("Password should atleast 8 character in length");
} else if (!(password).match(cpassword)) {
alert("Your passwords don't match. Try again");
} else {
$.post("signup.php", {
fnameof: fname,
lnameof: lname,
emailof: email,
usernameof: username,
passwordof: password
}, function(data) {
if (data == 'You have Successfully Registered') {
$("form")[0].reset();
}
alert(data);
});
}
});
});
function checkPasswordMatch() {
        var password = $("#form-password-css").val();
        var repeatPassword = $("#form-password-css-repeat").val();

        if (password != repeatPassword)
          $("#divCheckPasswordMatch").html("Passwords do not match!");
        else
          $("#divCheckPasswordMatch").html("Passwords match.");
    }
    $(document).ready(function () {
        $("#form-password-css-repeat").keyup(checkPasswordMatch);
    });