$(document).ready(function() {
 
 //When User hits the submit button
  $("#login").on('click', function() {
      var user = $("#username").val();
      var pass = $("#password").val();

    //Username or password is empty -> error
      if(user === "" || pass === "") {
          //add error message
          $("#resp").html("Cannot leave an empty username or password");
      }
      //Username is greater than 25 characters
      else if(user.length > 25) {
        $("#resp").html("Username is too long");
      }
      //Go to the signup php to insert in database
      else {
        $.ajax(
          {
            url: 'LAMPAPI/signup.php',
            method: 'POST',
            data: {
              login: 1,
              userPHP: user,
              passPHP: pass
            },
            
            success: function(response) {
                //Prints back response
              $("#resp").html(response);
                
                //If successful go to the login page
              if(response.indexOf('success') >= 0) {
                window.location = 'logging.php';
              }
            },
            dataType: 'text'
          }
        );
      }
  });
});
