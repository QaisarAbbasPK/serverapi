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
		
	$fid = $_GET['fid'];	
	$mid = $_GET['mid'];
	$oid = $_GET['oid'];	
	$startDate = $_GET['startDate'];	
	$endDate = $_GET['endDate'];	
	$areaRequested = $_GET['areaRequested'];	
	$id = null;
	$status = "notGranted";
	$sql = 'INSERT INTO ReservationRequest (rid,farmer_id,mid,status,owner_id,start_date, end_date, area_requested) VALUES(:id,:fid,:mid,:status,:oid, :startDate, :endDate, :areaRequested)';		
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	$stmt->bindParam(':fid', $fid, PDO::PARAM_STR);
	$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
	$stmt->bindParam(':mid', $mid, PDO::PARAM_STR);
	$stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
	$stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':areaRequested', $areaRequested, PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount())
	{
	
		$response["success"] = 1;
		$response["message"] = "Reservation request is submitted. Please, wait for reservation process";
		echo json_encode($response);
		
	}
	else {
		$response["success"] = 0;
		$response["message"] = $conn->error;
		echo json_encode($response);
	}	
	
		

?>