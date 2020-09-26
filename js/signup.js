$(document).ready(function() {
        $("#login").on('click', function() {
            var user = $("#username").val();
            var pass = $("#password").val();
            console.log(user);
            if(user == "" || pass == "") {
                //add error message 
                $("#resp").html("Check inputs");
            }
            else if(user.length > 25) {
              $("#resp").html("Username is too long");
            }
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
                      console.log(response);
                    $("#resp").html(response);

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