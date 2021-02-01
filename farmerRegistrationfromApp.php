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
		
	$firstName = $_GET['name'];	
	$lastName = $_GET['fatherName'];
	$CNIC = $_GET['cnic'];	
	$address = $_GET['address'];	
	$phone = $_GET['phone'];	
	$tehsil = $_GET['tehsil'];	
	$district = $_GET['district'];	
	$land = $_GET['land'];	
	$fid = null;
	$subsidy = 0;
	$password = $_GET['pass'];
	$gis_location_lat = $_GET['lat'];
	$gis_location_lng = $_GET['lng'];
	
	$sql1 = 'SELECT * FROM Farmer where nic=:nic';		
	$stmt1= $conn->prepare($sql1);
	$stmt1->bindParam(':nic', $CNIC, PDO::PARAM_STR);
	$stmt1->execute();	
	if( !$stmt1->rowCount()){
		$sql = 'INSERT INTO Farmer (fid,name, fname, nic, subsidy,address,phone,gis_location_lat,gis_location_lng, password,district,tehsil, land) VALUES(:fid,:firstName,:lastName,:CNIC,:subsidy, :address, :phone, :gis_location_lat,:gis_location_lng,:password, :district, :tehsil, :land)';		
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(':fid', $fid, PDO::PARAM_STR);
		$stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':CNIC', $CNIC, PDO::PARAM_STR);
		$stmt->bindParam(':subsidy', $subsidy, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindParam(':gis_location_lat', $gis_location_lat, PDO::PARAM_STR);
		$stmt->bindParam(':gis_location_lng', $gis_location_lng, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':district', $district, PDO::PARAM_STR);
		$stmt->bindParam(':tehsil', $tehsil, PDO::PARAM_STR);
		$stmt->bindParam(':land', $land, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount())
		{
		
			$response["success"] = 1;
			$response["message"] = "Service Recipient Registered Successfully.";
			echo json_encode($response);
			
		}
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Service Recipient's NIC already registered.";
		echo json_encode($response);
	}	
	
		

?>