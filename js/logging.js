$(document).ready(function() {
    //Cookies ----------
    //Get the remember cookie
    var remember = Cookies.get('remember');
    //If the user previously selected 'remember me', do the following...
    if(remember == 'true') {
      //Retrieve Username && Password
      var userC = Cookies.get('username');
      var passC = Cookies.get('password');
       //Fill in the username, password, and remember me box field
       $("#username").val(userC);
       $("#password").val(passC);
       $("#remember").prop("checked", true);
    }

$("#pwd").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
     var tog = $($(this).attr("toggle"));
     
     if(tog.attr("type") == "password") {
         tog.attr("type", "text");
     }
     else {
         tog.attr("type", "password");
     } }); 
     
    //If the login button selected
  $("#login").on('click', function() {
      var user = $("#username").val();
      var pass = $("#password").val();
    //Username or password is empty -> error
      if(user === "" || pass === "") {
          //add error message
          $("#resp").html("Cannot leave an empty username or password");
      }
     //Username is greater than 25 characters
      else if (user.length > 25) {
          $("#resp").html("Username is too long");
      }
     //Go to the login php to insert in database
      else {
         var hash = md5(pass);
        $.ajax(
          {
            url: 'LAMPAPI/login.php',
            method: 'POST',
            data: {
              login: 1,
              userPHP: user,
              passPHP: hash
            },
            success: function(response) {
             //Prints back response
              $("#resp").html(response);
            
             //If successful go to the directed page
              if(response.indexOf('success') >= 0) {
                  //Prints back response
                $("#resp").html("User login successfully!");
                  //Check if remember me box is selected
                  if($('#remember').is(':checked')) {
                    //Create 3 cookies username, password, remember
                    Cookies.set('username', user);
                    Cookies.set('password', pass);
                    Cookies.set('remember', "true");
                    }
                    //If the user didn't select remember me, remove the three cookies
                    else {
                        Cookies.remove("username");
                        Cookies.remove("password");
                        Cookies.remove("remember");
                    }
                window.location = 'directed.php';
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

