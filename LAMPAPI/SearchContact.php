<?php
session_start();

$inData = getRequestInfo();
$conn = new mysqli('localhost', 'cop4331g_POOPTEN', '7[DaQeU,awcw', 'cop4331g_COP4331_Group_10');

$sql ="SELECT * FROM contactInfo WHERE (contactFirstName LIKE '%" . $inData["search"] . "%' OR contactLastName LIKE '%" . $inData["search"] . "%' OR contactEmail LIKE '%" . $inData["search"] . "%' OR contactPhoneNumber LIKE '%" . $inData["search"] . "%') AND userID = '" . $inData["userID"] . "' ORDER BY contactFirstName";
$data = $conn->query($sql);

if($conn->connect_error)
{
  exit($conn->connect_error);
}

$outputhtml = "";
if ($data->num_rows <= 0)
{
  $outputhtml = "No Records Found";
}
while ($row = $data->fetch_assoc())
{
  $outputhtml = addContact($outputhtml,$row["contactFirstName"],$row["contactEmail"],$row["dateCreated"],$row["contactLastName"],$row["contactPhoneNumber"],$row["ID"]);
}

echo $outputhtml;


function addContact($appendStr, $firstName, $email, $date, $lastName, $phone, $id)
{
  $html = '<tr class="contact'.$id.'" id="contact'.$id.'row1">
      <td class="tb-fn">'.$firstName.'</td>
      <td class="tb-email">'.$email.'</td>
      <td class="tb-date">'.$date.'</td>
  </tr>
  <tr class="contact'.$id.'" id="contact'.$id.'row2">
      <td class="tb-ln">'.$lastName.'</td>
      <td class="tb-addr">'.$phone.'</td>
      <td class="tb-delete">
          <button class="btn edit-button" onclick="editContact('. $id .')"><i class="fas fa-edit"></i></button>
          <button class="btn delete-button" onclick="deleteContact('. $id .')"><i class="fas fa-trash-alt"></i></button>
      </td>
  </tr>
  <td class="tb-blank contact'.$id.'" id="contact'.$id.'row3" colspan="3"><br></td>
  ';
  return $appendStr . $html;
}

function getRequestInfo()
{
  return json_decode(file_get_contents('php://input'), true);
}

?>
