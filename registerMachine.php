<?php
	include("config.php");
	//session_start();
	$response = array();
	try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e)
		{
			die("OOPs something went wrong");
		}
		
	$cnic = $_POST['CNIC'];	
	$type= $_POST['type'];
	$regno = $_POST['regno'];	
	$make = $_POST['make'];	
	$model = $_POST['model'];	
	$length = $_POST['length'];	
	$width = $_POST['width'];	
	$height = $_POST['height'];	
	$data1 = [
			'nic' => $cnic
			];
		$sql1 = "SELECT * FROM Owner where nic=:nic";
		$stmt1= $conn->prepare($sql1);
		$stmt1->execute($data1);
		if($stmt1->rowCount()){
			foreach($stmt1 as $Owner){
				$oid = $Owner['oid'];
			}
			$mid = null;
			$sql = 'INSERT INTO Machinery (mid,type, owner_id, reg_no, make, model, length, width, height) VALUES(:mid,:type, :oid, :regno, :make, :model, :length, :width, :height )';		
			$stmt= $conn->prepare($sql);
			$stmt->bindParam(':mid', $mid, PDO::PARAM_STR);
			$stmt->bindParam(':type', $type, PDO::PARAM_STR);
			$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
			$stmt->bindParam(':regno', $regno, PDO::PARAM_STR);
			$stmt->bindParam(':make', $make, PDO::PARAM_STR);
			$stmt->bindParam(':model', $model, PDO::PARAM_STR);
			$stmt->bindParam(':length', $length, PDO::PARAM_STR);
			$stmt->bindParam(':width', $width, PDO::PARAM_STR);
			$stmt->bindParam(':height', $height, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount())
			{
			
				$response["success"] = 1;
				$response["message"] = "Machinery Registration Successful";
				echo json_encode($response);
				
			}	
			
			
		}
		else{
			$response["success"] = 0;
			$response["message"] = "Service Provider's CNIC does not exist.";
			echo json_encode($response);	
		}
		

?>