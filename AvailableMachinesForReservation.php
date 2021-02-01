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
	$startDate = $_GET['startDate'];	
	$endDate = $_GET['endDate'];	
	$machineType = $_GET['machineType'];	
	$data = [
		'nic' => $_GET['farmerNIC']
		];
	$sql = "SELECT * FROM Farmer WHERE nic=:nic";
	$stmt= $conn->prepare($sql);
	$stmt->execute($data);
	$count= 0;
	if($stmt->rowCount())
	{
	
		$response["success"] = 1;
		$response["farmer"] = array();
		$response["owner"] = array();
		foreach($stmt as $farmer){
			$frmer  = array();
			$frmer['id'] = $farmer['fid'];
			$frmer['name'] = $farmer['name'];
			$frmer['fname'] = $farmer['fname'];
			$frmer['lat'] = $farmer['gis_location_lat'];
			$frmer['lng'] = $farmer['gis_location_lng'];
			$frmer['address'] = $farmer['address'];
			$lat = $farmer['gis_location_lat'];
			$lng = $farmer['gis_location_lng'];
			array_push($response["farmer"],$frmer);
		}
		$data1 = [
					'machineType' => $_GET['machineType']
					];
				$sql1 = "SELECT * FROM Owner";
				$stmt1= $conn->prepare($sql1);
				$stmt1->execute();
				if($stmt1->rowCount()){
					foreach($stmt1 as $Owner){
						$oid=$Owner['oid'];
						$ownr_lat = $Owner['gis_location_lat'];
						$ownr_lng = $Owner['gis_location_lng'];
						$ownr_address = $Owner['address'];
						
						$dist =  distance(floatval($lat),floatval($lng),floatval($Owner['gis_location_lat']),floatval($Owner['gis_location_lng'])) ."<br>";
						if($dist < 100){
							$status = "available";
							$data2 = [
								'machineType' => $machineType,
								'oid' => $oid
							];
							$sql2 = "SELECT * FROM Machinery where owner_id=:oid AND type=:machineType";
							$stmt2= $conn->prepare($sql2);
							$stmt2->execute($data2);
							if($stmt2->rowCount()){
									
								/*$count++;
								$ownr = array();
								$ownr['id'] = $Owner['oid'];
								$ownr['name'] = $Owner['name'];
								$ownr['fname'] = $Owner['fname'];
								$ownr['dist'] = number_format($dist,2);
								array_push($response["owner"],$ownr);*/
								$count=0;
								foreach($stmt2 as $Machinery){
									$mid = $Machinery['mid'];
									$mregNo = $Machinery['reg_no'];
									$make = $Machinery['make'];
									$model = $Machinery['model'];
									$length = $Machinery['length'];
									$width = $Machinery['width'];
									$height = $Machinery['height'];
									$data3 = [
										'mid' => $mid,
										'startDate' => $startDate,
										'endDate' => $endDate
									];
									$sql3 = "SELECT * FROM ReservationRequest where mid=:mid AND start_date <= :endDate AND end_date >= :startDate";
									$stmt3= $conn->prepare($sql3);
									$stmt3->execute($data3);
									if($stmt3->rowCount()){
										
									}
									else{
										$count++;
										$ownr = array();
										$ownr['id'] = $Owner['oid'];
										$ownr['name'] = $Owner['name'];
										$ownr['fname'] = $Owner['fname'];
										$ownr['lat'] = $ownr_lat;
										$ownr['lng'] = $ownr_lng;
										$ownr['address'] = $ownr_address;
										$ownr['mid'] = $mid;
										$ownr['reg_no'] = $mregNo;
										$ownr['make'] = $make;
										$ownr['model'] = $model;
										$ownr['length'] = $length;
										$ownr['width'] = $width;
										$ownr['height'] = $height;
										$ownr['dist'] = number_format($dist,2);
										array_push($response["owner"],$ownr);
									}
									
								}
							}
						}
					}
					array_sort_by_column($response["owner"], 'dist');
				}
				if($count == 0){
					$response["success"] = 0;
					$response["message"] = "No machine available for the specified time.";
				}
		echo json_encode($response);
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Service Recipient not Registered.";
		echo json_encode($response);
	}	

		
		
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
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