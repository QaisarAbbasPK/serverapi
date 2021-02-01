
  <?php
  include("config.php");
	$response   = array();	
	if (isset($_GET['rid']) )
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
        
        $sql1 = 'Insert into CancelledReservation (Select * from ReservationRequest where rid= :rid)';
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
				$sql1 = 'SELECT * FROM CancelledReservation where rid= :rid';		
				$stmt1= $conn->prepare($sql1);
				$stmt1->bindParam(':rid', $rid, PDO::PARAM_STR);
				$stmt1->execute();
				if($stmt1->rowCount())
				{
					foreach($stmt1 as $rsrvation){
						$fid = $rsrvation['farmer_id'];
						$oid = $rsrvation['owner_id'];
						$sql2 = 'SELECT * FROM Farmer where fid= :fid';		
						$stmt2= $conn->prepare($sql2);
						$stmt2->bindParam(':fid', $fid, PDO::PARAM_STR);
						$stmt2->execute();
						if($stmt2->rowCount())
						{
							foreach($stmt2 as $frmr){
								$farmerName = $frmr['name']." ".$frmr['fname'];
							}
						}
					}
				}
				$rd = "https://obw4mkfypl.execute-api.us-west-2.amazonaws.com/prod?oid=".$oid."&farmerName=".urlencode($farmerName)."&rid=".$rid;
				$reqResponse = file_get_contents($rd);
				$response["success"] = 1;
				$response["message"] = "Reservation request deleted.";
				echo json_encode($response); 
			}
			else
			{
				$response["success"] = 0;
				$response["message"] = "Reservation can not be found/deleted.";
				
				echo json_encode($response);
			}
		}
		
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}	
		
	?>


