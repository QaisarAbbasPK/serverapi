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
	$firstName = $_GET['firstName'];	
	$lastName = $_GET['lastName'];
	$CNIC = $_GET['CNIC'];	
	$address = $_GET['address'];	
	$phone = $_GET['phone'];	
	
	$tehsil = $_GET['tehsil'];	
	$district = $_GET['district'];	
	$pass = 'null';	
	$arn='null';
	
	$oid = null;
	$subsidy = 'null';
	$gis_location_lat = 'null';
	$gis_location_lng = 'null';
	$imageLink = $_GET['image_link'];
	
	
	$sql1 = 'SELECT * FROM Owner where nic=:nic';		
	$stmt1= $conn->prepare($sql1);
	$stmt1->bindParam(':nic', $CNIC, PDO::PARAM_STR);
	$stmt1->execute();	
	if( !$stmt1->rowCount()){	
		$sql = 'INSERT INTO Owner (oid, name, fname, nic, subsidy,address,phone,gis_location_lat,gis_location_lng, password, arn, tehsil, district, image_link) VALUES(:oid,:firstName,:lastName,:CNIC,:subsidy, :address, :phone, :gis_location_lat,:gis_location_lng, :password, :arn, :tehsil, :district, :imageLink)';		
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
		$stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':CNIC', $CNIC, PDO::PARAM_STR);
		$stmt->bindParam(':subsidy', $subsidy, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindParam(':gis_location_lat', $gis_location_lat, PDO::PARAM_STR);
		$stmt->bindParam(':gis_location_lng', $gis_location_lng, PDO::PARAM_STR);
		$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
		$stmt->bindParam(':arn', $arn, PDO::PARAM_STR);
		$stmt->bindParam(':tehsil', $tehsil, PDO::PARAM_STR);
		$stmt->bindParam(':district', $district, PDO::PARAM_STR);
		$stmt->bindParam(':imageLink', $imageLink, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount())
		{
		
			$response["success"] = 1;
			$response["message"] = "Service Provider Registered Successfully.";
			echo json_encode($response);
			
		}
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Service Provider's NIC already registered.";
		echo json_encode($response);
	}	
	
		

?>