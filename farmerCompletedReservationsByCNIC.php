<?php
	include("config.php");
	//session_start();
	$response   = array();
	try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e)
		{
			die("OOPs something went wrong");
		}
	$nic = $_GET['cnic'];
	
	$data1 = [
		'nic' => $nic
		];
	$sql1 = "SELECT * FROM Farmer WHERE nic=:nic";
	$stmt1= $conn->prepare($sql1);
	$stmt1->execute($data1);
	if($stmt1->rowCount())
	{
		foreach($stmt1 as $farmer){
			$fid = $farmer['fid'];
		}
		$data = [
		'fid' => $fid
		];
		$sql = "SELECT * FROM ReservationHistory1 where farmer_id = :fid";
		$stmt= $conn->prepare($sql);
		$stmt->execute($data);
		$count= 0;
		if($stmt->rowCount())
		{
		
			$response["success"] = 1;
			$response["reservations"] = array();
			foreach($stmt as $reservation){
				$Reservation  = array();
				$Reservation['rid'] = $reservation['rid'];
				////////////////////////////////////////////////
				$data1 = [
				'rid' => $reservation['rid']
				];
				$sql1 = "SELECT * FROM Bill where rid = :rid";
				$stmt1= $conn->prepare($sql1);
				$stmt1->execute($data1);
				if($stmt1->rowCount()){
					foreach($stmt1 as $bill)
						$Reservation['billAmount'] = intval($bill['amount']);
				}
				else{
					$Reservation['billAmount'] = 0;
				}
				/////////////////////////////////////////////////////
				$Reservation['farmer_id'] = $reservation['farmer_id'];
				$Reservation['mid'] = $reservation['mid'];
				$Reservation['status'] = $reservation['status'];
				$Reservation['owner_id'] = $reservation['owner_id'];
				$Reservation['start_date'] = $reservation['start_date'];
				$Reservation['end_date'] = $reservation['end_date'];
				$Reservation['area_requested'] = $reservation['area_requested'];
				$Reservation['data_link'] = $reservation['data_link'];
				$Reservation['request_date'] = $reservation['request_date'];
				$Reservation['actual_area'] = $reservation['actual_area'];
				$Reservation['authenticity'] = $reservation['authenticity'];
						////////////
				$sql1 = 'SELECT * FROM Farmer WHERE  fid = :farmerID';
				$stmt1 = $conn->prepare($sql1);
				$stmt1->bindParam(':farmerID', $Reservation['farmer_id'], PDO::PARAM_STR);
				$stmt1->execute();
				if (!empty($stmt1)) {
					foreach($stmt1 as $farmer) {
						$Reservation["FarmerName"] = $farmer['name'];
						$Reservation["FarmerLastName"] = $farmer['fname'];
					}
				}
				/////////////
				$sql2 = 'SELECT * FROM Machinery WHERE  mid = :mid';
				$stmt2 = $conn->prepare($sql2);
				$stmt2->bindParam(':mid', $Reservation["mid"], PDO::PARAM_STR);
				$stmt2->execute();
				if (!empty($stmt2)) {
					foreach($stmt2 as $machinery) {
						$Reservation["machineType"] = $machinery['type'];
						$Reservation["make"] = $machinery['make'];
						$Reservation["model"] = $machinery['model'];
					}
				}
				////////////
				/////////////
				$sql2 = 'SELECT * FROM Owner WHERE  oid = :oid';
				$stmt2 = $conn->prepare($sql2);
				$stmt2->bindParam(':oid', $Reservation["owner_id"], PDO::PARAM_STR);
				$stmt2->execute();
				if (!empty($stmt2)) {
					foreach($stmt2 as $owner) {
						$Reservation["OwnerName"] = $owner['name'];
						$Reservation["OwnerLastName"] = $owner['fname'];
						$Reservation["address"] = $owner['address'];
					}
				}
				////////////
				
				
				array_push($response["reservations"],$Reservation);
			}
			echo json_encode($response);
		}
		else {
			$response["success"] = 0;
			$response["message"] = "No reservation found.";
			echo json_encode($response);
		}	
	}
	else{
		$response["success"] = 0;
		$response["message"] = "No reservation found.";
		echo json_encode($response);
	}
	
	

	


	
?>