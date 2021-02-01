<?php
	include ("config.php");
	// declaring array for JSON response 
	$response = array();

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e){
		die("Cannot Connect!!Something went wrong");
	}

	$cnic = $_GET['cnic'];

	$data1 = [
		'nic' => $cnic
	];

	$sql1 = "SELECT * FROM Owner where nic = :nic";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->execute($data1);

	if($stmt1 -> rowCount()){
		$response["success"] = 1;
		$response["Profile_Details"] = array();

		foreach ($stmt1 as $Profile_Details){
			$Prof_Details = array();
			$Prof_Details['name'] = $Profile_Details['name'];
			$Prof_Details['cnic'] = $Profile_Details['nic'];
			$Prof_Details['address'] = $Profile_Details['address'];
			$Prof_Details['phnum'] = $Profile_Details['phone'];
			$Prof_Details['district'] = $Profile_Details['district'];
			$Prof_Details['tehsil'] = $Profile_Details['tehsil'];
			array_push($response["Profile_Details"], $Prof_Details);
		}
	}

	else{
		// no row found
		$response["success"] = 0;
		$response["message"] = "Service Provider's CNIC is not registered";
		// echo no users JSON
	}

	echo json_encode($response); 
?>

