
  <?php
  include("config.php");
	$response   = array();	
	if (isset($_GET['cnic']) && isset($_GET['pwd']) && isset($_GET['flag']))
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
        $pwd=$_GET['pwd'];
		$flag = $_GET['flag'];
        $sql = 'SELECT * FROM Owner WHERE nic = :nic' ;
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':nic', $cnic, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount())
		{	
			if( $flag == 'true'){
				$sql = 'UPDATE Owner SET password = :pwd WHERE nic = :nic';
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
				$stmt->bindParam(':nic', $cnic, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount())
				{	
					$response["success"] = 1;
					$response["message"] = "Authentication successful";
					$response["Owner"] = array();
					$sql1 = 'SELECT * FROM Owner WHERE nic = :nic';
					$stmt1 = $conn->prepare($sql1);
					$stmt1->bindParam(':nic', $cnic, PDO::PARAM_STR);
					$stmt1->execute();
					foreach ($stmt1 as $owner){
						$ownr = array();
						$ownr['id'] = $owner['oid'];
						$ownr['name'] = $owner['name']. " ".$owner['fname']; 
						$ownr['address'] = $owner['address']; 
						$ownr['gis_location_lat'] = $owner['gis_location_lat']; 
						$ownr['gis_location_lng'] = $owner['gis_location_lng']; 
						array_push($response["Owner"],$ownr);
						
					}
				}
				else
				{
					$response["success"] = 0;
					$response["message"] = "CNIC Or Password Invalid!";
				}
			}	
			else{
				$pass = '';
				$sql = 'SELECT * FROM Owner WHERE  nic = :nic';
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':nic', $cnic, PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount())
				{
					foreach ($stmt as $owner){
						$pass = $owner['password'];
					}
					if ($pass == 'null'){
						$response['success'] = 0;
						$response['message'] = 'Kindly, create new password. You are logging in for the first time.';
					}
					else if($pass == $pwd){
						$response['success'] = 1;
						$response['message'] = 'Sign in successful.';
					}
					else {
						$response['success'] = 0;
						$response['message'] = 'Invalid password.';
					}
				}
			}
		}
		else{
			$response["success"] = 0;
			$response["message"] = "Service Providers CNIC is not registered!";
		}
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
	}	
		
	
	echo json_encode($response); 		
?>


