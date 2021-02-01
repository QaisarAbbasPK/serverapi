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
	$rid = $_GET['rid'];	
	$fid = $_GET['fid'];	
	$mid = $_GET['mid'];
	$oid = $_GET['oid'];	
	$startDate = $_GET['startDate'];	
	$endDate = $_GET['endDate'];	
	$areaRequested = $_GET['areaRequested'];	
	$id = null;
	$status = "pending";
	$sql = 'UPDATE ReservationRequest SET farmer_id = :fid, mid = :mid, status = :status, owner_id = :oid, start_date = :startDate, end_date = :endDate,area_requested = :areaRequested WHERE rid = :rid';		
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':rid', $rid, PDO::PARAM_STR);
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
		$response["message"] = "Reservation request is updated. Please, wait for reservation process";
		echo json_encode($response);
		
	}
	else {
		$response["success"] = 0;
		$response["message"] = $conn->error;;
		echo json_encode($response);
	}	
	
		

?>