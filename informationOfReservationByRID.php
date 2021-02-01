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
	$rid = $_GET['rid'];
	
		
		$data = [
		'rid' => $rid
		];
		$sql = "SELECT * FROM ReservationHistory1 where rid = :rid";
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
				$Reservation['url'] = $reservation['data_link'];
				$Reservation['actual_Area'] = $reservation['actual_Area'];
				$Reservation['study_completion_time'] = $reservation['study_completion_time'];
				$Reservation['actual_activity_duration'] = $reservation['actual_activity_duration'];
				$Reservation['actual_time_to_field'] = $reservation['actual_time_to_field'];
				$Reservation['travel_distance_to_field'] = $reservation['travel_distance_to_field'];
				
				
				array_push($response["reservations"],$Reservation);
			}
			
			echo json_encode($response);
		}
		else {
			$response["success"] = 0;
			$response["message"] = "No reservation found.";
			echo json_encode($response);
		}	
	


	
?>