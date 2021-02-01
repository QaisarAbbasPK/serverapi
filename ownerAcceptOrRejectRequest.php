
  <?php
  include("config.php");
	$response   = array();	
	if (isset($_GET['rid']) && isset($_GET['status']))
	{	
        try {
            	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
            	die("OOPs something went wrong");
            }	
        
        $rid=$_GET['rid'];
        $status=$_GET['status'];
		if($status == "accepted"){
			$sql = 'UPDATE ReservationRequest SET status=:status WHERE rid=:rid';
			  $stmt = $conn->prepare($sql);
			  $stmt->bindParam(':status', $status, PDO::PARAM_STR);
			  $stmt->bindParam(':rid', $rid, PDO::PARAM_STR);
			  $stmt->execute();
			if($stmt->rowCount())
			{
				$response["success"] = 1;
				$response["message"] = "Reservation request accepted.";
				echo json_encode($response);
			}
			else
			{
				$response["success"] = 0;
				echo json_encode($response);
			}
		}
		if($status == "notAccepted"){
			//////////////////////////////////////////////////////////////////
			$sql1 = 'Insert into RejectedReservation (Select * from ReservationRequest where rid= :rid)';
			$stmt1 = $conn->prepare($sql1);
			$stmt1->bindParam(':rid', $rid, PDO::PARAM_STR);
			$stmt1->execute();
			if($stmt1->rowCount())
			{
			$sql = 'Delete FROM ReservationRequest WHERE  rid = :rid';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':rid', $rid, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount())
			{
				$response["success"] = 1;
				$response["message"] = "Reservation request rejected.";
				echo json_encode($response); 
			}
			else
			{
				$response["success"] = 0;
				$response["message"] = "Reservation can not be found/deleted.";
				echo json_encode($response);
			}
			}
			///////////////////////////////////////////////////////////////////
		}
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}	
		
	?>


