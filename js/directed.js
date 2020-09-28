function displayAddTable() {
   document.querySelector('.shadowAdd').style.display = "flex";
   document.querySelector('.typicalList').style.display="none";
}

function closeTable() {
  document.querySelector('.shadowAdd').style.display = "none";
  document.querySelector('.typicalList').style.display="flex";
}

function addContacts() {
  var firstName = document.getElementById("fn").value;
  var lastName = document.getElementById("ln").value;
  var email = document.getElementById("em").value;
  var phoneNumber = document.getElementById("pn").value;

  var jsonData = JSON.stringify({"firstName": firstName, "lastName": lastName, "email": email, "phoneNumber": phoneNumber, "uid": uid});

  $.ajax({
    url: 'LAMPAPI/AddContact.php',
    method: 'POST',
    dataType: 'json',
    data: jsonData,
    contentType:'application/json',
    success: function(result)
    {
      //(result);
    },
    error: function(xhr, ajaxOptions, thrownError)
    {
        if(xhr.status == 200) {

        }
        else {
          alert("AHHHHHHH: "+ xhr.status);
          alert(xhr.responseText);
        }
    }
  });
}

$(document).ready(function()
{
  var jsonData = JSON.stringify({"search": "", "userID": uid});
  $.ajax({
    url: 'LAMPAPI/SearchContact.php',
    method: 'POST',
    dataType: 'html',
    data: jsonData,
    contentType:'application/json',
    success: function(result)
    {
      var ihtml = '<table>' + result + '</table>'
      var element = document.getElementById('listedTables').innerHTML = ihtml;
    },
    error: function(xhr, ajaxOptions, thrownError)
    {
      alert("AHHHHHHH: "+ xhr.status);
      alert(thrownError);
    }
  });

  $('#searchbtn').on('click', function(){
    searchForContacts();
  });

  $('#searchbar').on('keydown', function(event){
    if (event.keyCode === 13)
    {
      searchForContacts();
    }
  });
});

function searchForContacts()
{
  var searchInput = $('#searchbar').val();
  var jsonData = JSON.stringify({"search": searchInput, "userID": uid});

  $.ajax({
    url: 'LAMPAPI/SearchContact.php',
    method: 'POST',
    dataType: 'html',
    data: jsonData,
    contentType:'application/json',
    success: function(result)
    {
      var ihtml = '<table>' + result + '</table>'
      var element = document.getElementById('listedTables').innerHTML = ihtml;
    },
    error: function(xhr, ajaxOptions, thrownError)
    {
      alert("AHHHHHHH: "+xhr.status);
      alert(thrownError);
    }
  });
}

function deleteContact(contactID)
{
  var toDelete = confirm("Do you want to delete this contact?");
  if (toDelete == true)
  {
    var jsonData =  JSON.stringify({"ID": contactID});
    $.ajax({
      url: 'LAMPAPI/DeleteContact.php',
      method: 'POST',
      dataType: 'json',
      data: jsonData,
      contentType:'application/json',
      success: function(result)
      {
        searchForContacts();
      },
      error: function(xhr, ajaxOptions, thrownError)
      {
        alert("AHHHHHHH: "+xhr.status);
        alert(thrownError);
      }
    });
  }
}

function editContact(contactID)
{
  var table = document.getElementById('listedTables');
  buttons = table.getElementsByTagName('button');
  for (var i = 0, len = buttons.length; i < len; i++)
  {
    buttons[i].disabled = true;
  }
  var id = 'contact'+contactID+"row1";
  var row = document.getElementById(id)
  cells = row.getElementsByTagName('td');
  var ihtml = '<form><td class="tb-fn"><input id="firstNameInput" class="fill-in" type="text" placeholder="First Name" value="'+cells[0].innerHTML+'"></td> \
  <td class="tb-email"><input id="emailAddressInput" class="fill-in" type="text" placeholder="Email Address" value="'+cells[1].innerHTML+'"></td> \
  <td class="tb-date">'+cells[2].innerHTML+'</td></form>';

  var id2 ='contact'+contactID+"row2";
  var row2 = document.getElementById(id2)
  cells2 = row2.getElementsByTagName('td');
  var ihtml2 = '<form><td class="tb-ln"><input id="lastNameInput" class="fill-in" type="text" placeholder="Last Name" value="'+cells2[0].innerHTML+'"></td> \
  <td class="tb-addr"><input id="phoneNumberInput" class="fill-in" type="text" placeholder="Phone Number" value="'+cells2[1].innerHTML+'"></td> \
  <td class="tb-delete"> \
      <button type="button" class="btn edit-button" onclick="updateContact('+contactID+')"><i class="fas fa-check"></i></button> \
      <button type="button" class="btn delete-button-off" disabled><i class="fas fa-trash-alt"></i></button> \
  </td></form>';
  row.innerHTML = ihtml;
  row2.innerHTML = ihtml2;
}

function updateContact(contactID)
{
  var firstName = document.getElementById("firstNameInput").value;
  var email = document.getElementById("emailAddressInput").value;
  var lastName = document.getElementById("lastNameInput").value;
  var phone = document.getElementById("phoneNumberInput").value;

  var jsonData = JSON.stringify({"firstname": firstName, "lastname": lastName, "email": email, "phonenumber": phone, "id": contactID});
  $.ajax({
    url: 'LAMPAPI/UpdateContact.php',
    method: 'POST',
    dataType: 'json',
    data: jsonData,
    contentType:'application/json',
    success: function(result)
    {
      searchForContacts();
    },
    error: function(xhr, ajaxOptions, thrownError)
    {
      alert("AHHHHHHH: "+xhr.status);
      alert(thrownError);
    }
  });
}