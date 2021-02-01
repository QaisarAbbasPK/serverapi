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
	$nic = $_POST['nic'];	
	$data1 = [
		'nic' => $nic
	];
	$sql1 = "SELECT * FROM Owner WHERE nic=:nic";
	$stmt1= $conn->prepare($sql1);
	$stmt1->execute($data1);
	if($stmt1->rowCount())
	{
		foreach($stmt1 as $owner){
			$oid = $owner['oid'];
		}
		$data = [
		'oid' => $oid
		];
		$sql = "SELECT * FROM ReservationHistory1 WHERE owner_id=:oid";
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
					}
				}
				////////////

				////////////
				$sql_billing = 'SELECT * FROM Bil where rid = :rid';
				$stmt_billing = $conn->prepare($sql_billing);
				$stmt_billing->bindParam(':rid', $Reservation['rid'], PDO::PARAM_STR);
				$stmt_billing->execute();
				if (!empty($stmt_billing)) {
					foreach($stmt_billing as $bil) {
						$Reservation["BillAmount"] = $bil['amount'];
					}
				}
				///////////

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