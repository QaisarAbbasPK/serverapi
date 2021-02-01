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
	$response["success"] = 1;
	$response["reservations"] = array();
	$sql = "SELECT * FROM ReservationHistory1";
	$stmt= $conn->prepare($sql);
	$stmt->execute();
	$count= 0;
	if($stmt->rowCount())
	{
	

		foreach($stmt as $reservation){
			$count++;
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
			$Reservation['request_date'] = $reservation['request_date'];
			$Reservation['study_completion_time'] = $reservation['study_completion_time'];
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
			$sql3 = 'SELECT * FROM Owner WHERE  oid = :oid';
			$stmt3 = $conn->prepare($sql3);
			$stmt3->bindParam(':oid', $Reservation["owner_id"], PDO::PARAM_STR);
			$stmt3->execute();
			if (!empty($stmt3)) {
				foreach($stmt3 as $owner) {
					$Reservation["OwnerName"] = $owner['name'];
					$Reservation["OwnerLastName"] = $owner['fname'];
				}
			}
			////////////
			$sql_billing = 'SELECT * FROM Bil where rid = :rid';
			$stmt_billing = $conn->prepare($sql_billing);
			$stmt_billing->bindParam(':rid', $Reservation['rid'], PDO::PARAM_STR);
			$stmt_billing->execute();
			if (!empty($stmt_billing)) {
				foreach($stmt_billing as $bil) {
					$Reservation["BillAmount"] = $bil['final_amount'];
				}
			}
			///////////

			array_push($response["reservations"],$Reservation);
		}
	}
	$sql4 = "SELECT * FROM ReservationHistory2";
	$stmt4= $conn->prepare($sql4);
	$stmt4->execute();
	if($stmt4->rowCount())
	{
	
		foreach($stmt4 as $reservation){
			$count++;
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
			$Reservation['request_date'] = $reservation['request_date'];
			$Reservation['study_completion_time'] = $reservation['study_completion_time'];
			////////////
			$sql5 = 'SELECT * FROM Farmer WHERE  fid = :farmerID';
			$stmt5 = $conn->prepare($sql5);
			$stmt5->bindParam(':farmerID', $Reservation['farmer_id'], PDO::PARAM_STR);
			$stmt5->execute();
			if (!empty($stmt5)) {
				foreach($stmt5 as $farmer) {
					$Reservation["FarmerName"] = $farmer['name'];
					$Reservation["FarmerLastName"] = $farmer['fname'];
				}
			}
			/////////////
			$sql6 = 'SELECT * FROM Machinery WHERE  mid = :mid';
			$stmt6 = $conn->prepare($sql6);
			$stmt6->bindParam(':mid', $Reservation["mid"], PDO::PARAM_STR);
			$stmt6->execute();
			if (!empty($stmt6)) {
				foreach($stmt6 as $machinery) {
					$Reservation["machineType"] = $machinery['type'];
				}
			}
			////////////
			/////////////
			$sql7 = 'SELECT * FROM Owner WHERE  oid = :oid';
			$stmt7 = $conn->prepare($sql7);
			$stmt7->bindParam(':oid', $Reservation["owner_id"], PDO::PARAM_STR);
			$stmt7->execute();
			if (!empty($stmt7)) {
				foreach($stmt7 as $owner) {
					$Reservation["OwnerName"] = $owner['name'];
					$Reservation["OwnerLastName"] = $owner['fname'];
				}
			}
			////////////
			////////////
			$sql_billing2 = 'SELECT * FROM Bil where rid = :rid';
			$stmt_billing2 = $conn->prepare($sql_billing2);
			$stmt_billing2->bindParam(':rid', $Reservation['rid'], PDO::PARAM_STR);
			$stmt_billing2->execute();
			if (!empty($stmt_billing2)) {
				foreach($stmt_billing2 as $bil2) {
					$Reservation["BillAmount"] = $bil2['final_amount'];
				}
			}
			////////////
			array_push($response["reservations"],$Reservation);
		}
	}
	if ($count ==0) {
		$response["success"] = 0;
		$response["message"] = "No Reservations";

	}	
		echo json_encode($response);
	
?>