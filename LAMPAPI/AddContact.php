<?php


	$inData = getRequestInfo();

	$id = 0;
	$username = "";
	$password = "";

	$conn = new mysqli("localhost", "cop4331g_POOPTEN", "7[DaQeU,awcw", "cop4331g_COP4331_Group_10");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
	   
            $sql =  "INSERT INTO contactInfo (userID, contactFirstName, contactLastName, contactEmail, contactPhoneNumber, dateCreated) VALUES 
            ('" . $inData["uid"] . "','" . $inData["firstName"] . "','" . $inData["lastName"] . "','" . $inData["email"] . "','" . $inData["phoneNumber"] . "', curdate())";
            
	    	$data  = $conn->query($sql);
		
		    if($data === TRUE) {
                exit('success');
		    }
		    else
		    {
			    returnData($conn->error);
		    }
		    $conn->close();
		}
	

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnData( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
 

?>
