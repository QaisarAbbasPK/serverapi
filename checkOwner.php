
  <?php
  include("config.php");
	$response   = array();	
	if (isset($_GET['cnic']) )
	{	
        try {
            	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
            	die("OOPs something went wrong");
            }	
        
        $cnic=$_GET['cnic'];
        
        $sql = 'SELECT * FROM Owner WHERE  nic = :nic ';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':nic', $cnic, PDO::PARAM_STR);
          $stmt->execute();
        if($stmt->rowCount())
        {
			$response["success"] = 1;
			$response["message"] = "Authentication successful";
			$response["Owner"] = array();
			foreach ($stmt as $owner){
				$ownr = array();
				$ownr['id'] = $owner['oid'];
				$ownr['name'] = $owner['name']. " ".$owner['fname']; 
				$ownr['address'] = $owner['address']; 
				$ownr['gis_location_lat'] = $owner['gis_location_lat']; 
				$ownr['gis_location_lng'] = $owner['gis_location_lng']; 
				array_push($response["Owner"],$ownr);
				
		}
			
			
			echo json_encode($response); 
		}
		else
		{
			$response["success"] = 0;
			$response["message"] = "RegisterOwner";
			echo json_encode($response);
        }
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}	
		
	?>


