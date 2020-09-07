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
		$sql = "SELECT ID, username, password FROM loginInfo where username='" . $inData["username"] . "' and password='" . $inData["password"] . "'";
        $result = $conn->query($sql);
        
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$id = $row["ID"];
			returnWithInfo( $id );
		}
		else
		{
			returnWithError( "No Records Found" );
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

	function returnWithError( $err )
	{
		$retValue = '{"id":0,"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

	function returnWithInfo($id )
	{
		$retValue = '{"id":' . $id . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}

?>