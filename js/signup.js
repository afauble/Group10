$(document).ready(function() {
 
 $(".toggle-password").click(function() {
     $(this).toggleClass("fa-eye fa-eye-slash");
     var tog = $($(this).attr("toggle"));
     
     if(tog.attr("type") == "password") {
         tog.attr("type", "text");
     }
     else {
         tog.attr("type", "password");
     }
 }); 
 
 //When User hits the submit button
  $("#login").on('click', function() {
      var user = $("#username").val();
      var pass = $("#password").val();
      var passConfirm = $("#confirmPassword").val();
      
    //Username or password is empty -> error
      if(user == "" || pass == "" || passConfirm == "") {
          //add error message
          $("#resp").html("Cannot leave an empty username or password");
      }
      //Username is greater than 25 characters
      else if(user.length > 25) {
        $("#resp").html("Username is too long");
      }
      else if(pass != passConfirm) {
         $("#resp").html("Passwords do not match!");
      }
      //Go to the signup php to insert in database
      else {
          var hash = md5(pass); 
        $.ajax(
          {
            url: 'LAMPAPI/signup.php',
            method: 'POST',
            data: {
              login: 1,
              userPHP: user,
              passPHP: hash
            },
            
            success: function(response) {
              //If successful go to the login page
              if(response.indexOf('success') >= 0) {
                  //Prints back response
              $("#resp").html("User successfully signed up!");
                window.location = 'logging.php';
              }
              else {
                //Prints back response
              $("#resp").html(response);
              }
            },
            dataType: 'text'
          }
        );
      }
  });
});
