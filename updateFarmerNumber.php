
  <?php
  include("config.php");
	$response   = array();	
	if (isset($_GET['phone']) && isset($_GET['cnic']) )
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
        $phone=$_GET['phone'];
        
        $sql = 'UPDATE Farmer SET phone = :phone where nic = :cnic';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':cnic', $cnic, PDO::PARAM_STR);
          $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
          $stmt->execute();
        if($stmt->rowCount())
        {
			$response["success"] = 1;
			$response["message"] = "Phone number updated.";
			echo json_encode($response); 
		}
		else
		{
			$response["success"] = 0;
			$response["message"] = "CNIC Or Password Invalid!";
			echo json_encode($response);
        }
	}
	else{
		$response["success"] = 0;
		$response["message"] = "Required fields missing.";
		echo json_encode($response);
	}	
		
	?>


