<?php
	include ("config.php");
	// declaring array for JSON response 
	$response = array();
	if (isset($_GET['is_Active']) && isset($_GET['cnic']) )
	{
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e){
			die("Cannot Connect!!Something went wrong");
		}

		$cnic = $_GET['cnic'];
		$is_Active = $_GET['is_Active'];

		$sql = "SELECT * FROM Owner where nic = :cnic";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':cnic', $cnic, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount())
		{
			foreach($stmt as $Owner)
			{
				$stat = $Owner['status'];
			}
			if($is_Active == $stat)
			{
				$response["success"] = 1;
				$response["message"] = "Same Status given!!";
				echo json_encode($response);
			}
			else
			{
				$sql1 = "UPDATE Owner SET status = :is_Active where nic = :cnic";
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':is_Active', $is_Active, PDO::PARAM_STR);
				$stmt1->bindParam(':cnic', $cnic, PDO::PARAM_STR);
				$stmt1->execute();

				if($stmt1->rowCount())
				{
					$response["success"] = 1;
					$response["message"] = "Status Updated";
					echo json_encode($response);
				}
				else
				{
					$response["success"] = 0;
					$response["message"] = "Status couldn't be updated";
					echo json_encode($response);
				}	
			}		
		}
		else
		{
			$response["success"] = 0;
			$response["message"] = "CNIC invalid!!";
			echo json_encode($response);
		}		
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}

?>

