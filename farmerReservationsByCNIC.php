<?php
$servername = "rms-rds-wordpress.csng6ork1n2r.us-east-2.rds.amazonaws.com";
$username   = "admin";
$password   = "Dcse123#";
$dbname     = "agricultural_db";
// array for JSON response
$response   = array();
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("OOPs something went wrong");
}
$olat=0;
$olng=0;
$flat=0;
$flng=0;
if (isset($_GET['cnic']) ) {
    $farmerCNIC      = $_GET['cnic'];
	// Query database for row exist or not
	$sql1 = 'SELECT fid FROM Farmer WHERE  nic = :farmerCNIC';
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':farmerCNIC', $farmerCNIC, PDO::PARAM_STR);
	$stmt1->execute();
	if ($stmt1->rowCount()){
		foreach($stmt1 as $farmer){
			$farmerID = $farmer['fid'];
		}	
		$sql = 'SELECT * FROM ReservationRequest where farmer_id= :farmerID ORDER BY rid DESC';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':farmerID', $farmerID, PDO::PARAM_STR);
		$stmt->execute();
		if ($stmt->rowCount()) {
		$response["success"] = 1;
		$response["reservations"] = array();
		foreach($stmt as $row) {
			// temp user array
			$reservation = array();
			$reservation["rid"] = $row["rid"];
			$reservation["farmer_id"] = $row["farmer_id"];
			$reservation["mid"] = $row["mid"];
			$reservation["status"] = $row["status"];
			$reservation["owner_id"] = $row["owner_id"];
			$reservation["start_date"] = $row["start_date"];
			$reservation["end_date"] = $row["end_date"];
			$reservation["area_requested"] = $row["area_requested"];
			$reservation["data_link"] = $row["data_link"];
			$reservation["request_date"] = $row["request_date"];
			////////////
			$sql1 = 'SELECT * FROM Farmer WHERE  fid = :farmerID';
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':farmerID', $reservation["farmer_id"], PDO::PARAM_STR);
			$stmt1->execute();
			if (!empty($stmt1)) {
				foreach($stmt1 as $farmer) {
					$reservation["Name"] = $farmer['name']." ".$farmer['fname'];
					$reservation["address"] = $farmer['address'];
					$flat= $farmer['gis_location_lat'];
					$flng=$farmer['gis_location_lng'];
				}
			}
			/////////////
			$sql2 = 'SELECT * FROM Machinery WHERE  mid = :mid';
			$stmt2 = $conn->prepare($sql2);
			$stmt2->bindParam(':mid', $reservation["mid"], PDO::PARAM_STR);
			$stmt2->execute();
			if (!empty($stmt2)) {
				foreach($stmt2 as $machinery) {
					$reservation["machineType"] = $machinery['type'];
					$reservation["width"] = $machinery['width'];
					$reservation["make"] = $machinery['make'];
					$reservation["model"] = $machinery['model'];
					
				}
			}
			////////////
			/////////////
			$sql3 = 'SELECT * FROM Owner WHERE  oid = :oid';
			$stmt3 = $conn->prepare($sql3);
			$stmt3->bindParam(':oid', $reservation["owner_id"], PDO::PARAM_STR);
			$stmt3->execute();
			if (!empty($stmt3)) {
				foreach($stmt3 as $owner) {
					$reservation["owner name"] = $owner['name']." ".$owner['fname'];
					$reservation["owner_address"] = $owner['address'];
					$reservation["owner_address"] = $owner['address'];
					$olat= $owner['gis_location_lat'];
					$olng=$owner['gis_location_lng'];
					
				}
			}
			////////////
			// push single product into final response array
			
			$dist =  distance(floatval($flat),floatval($flng),floatval($olat),floatval($olng));
			$reservation["dist"] =  number_format($dist,2);
						
			array_push($response["reservations"], $reservation);
		}
		// success\
		// echoing JSON response
		echo json_encode($response);
		} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "Currently, no reservation requests by Service Reccipient";
		// echo no users JSON
		echo json_encode($response);
		}
	}
	else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "Service Recipient's CNIC is not registered";
		// echo no users JSON
		echo json_encode($response);
		}
	
	
    
}

else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "Required fields missing...";
    echo json_encode($response);
}

function distance($lat1, $lon1, $lat2, $lon2) {
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
 return ($miles * 1.609344);
   
}

?>
