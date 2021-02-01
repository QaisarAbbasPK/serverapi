<?php
	include ("config.php");
	// declaring array for JSON response 
	$response = array();
	if (isset($_GET['oldpwd']) && isset($_GET['newpwd']) && isset($_GET['cnic']) )
	{
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e){
			die("Cannot Connect!!Something went wrong");
		}

		$cnic = $_GET['cnic'];
		$oldpwd = $_GET['oldpwd'];
		$newpwd = $_GET['newpwd'];

		$sql = "SELECT * FROM Farmer where nic = :cnic";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':cnic', $cnic, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount())
		{
			foreach($stmt as $Farmer)
			{
				$password = $Farmer['password'];
			}

			if($oldpwd != $password)
			{
				$response["success"] = 0;
				$response["message"] = "your current password is invlaid";
				echo json_encode($response);
			}
			else if ($oldpwd == $newpwd)
			{
				$response["success"] = 1;
				$response["message"] = "This is already your password";
				echo json_encode($response);
			}
			else if ($oldpwd == $password)
			{
				$sql1 = "UPDATE Farmer SET password = :newpwd WHERE password = :oldpwd";
				$stmt1 = $conn->prepare($sql1);
    			$stmt1->bindParam(':oldpwd', $oldpwd, PDO::PARAM_STR);
    			$stmt1->bindParam(':newpwd', $newpwd, PDO::PARAM_STR);
				$stmt1->execute();

				if($stmt1 -> rowCount()){
					$response["success"] = 1;
					$response["message"] = "Password Successfully updated";
					echo json_encode($response);
				}
				else{
					// no row found
					$response["success"] = 0;
					$response["message"] = "Service Recipient's CNIC is not registered";
					// echo no users JSON
				}

			}
		}
		
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}

?>

