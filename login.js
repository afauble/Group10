function login()
{
//to-do: HASH PASSWORD

  var username = document.getElementsByTagName("input")[0].value;
  var password = document.getElementsByTagName("input")[1].value;

  $.ajax({
    type: "POST",
    url: "LAMPAPI/Login.php",
    dataType: 'json',
    data: {"username": username, "password": password},
    success: function(data){alert("IT WORKED! "+data.id+" : "+data.error);}
  })

}
