
  <?php
  include("config.php");
	$response   = array();	   
	if (isset($_GET['cnic']) && isset($_GET['pwd']))
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
        
        $sql = 'SELECT * FROM Farmer WHERE  nic = :nic AND password = :pwd';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':nic', $cnic, PDO::PARAM_STR);
          $stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
          $stmt->execute();
        if($stmt->rowCount())
        {
			$response["farmer"] = array();
			foreach ($stmt as $farmer){
				$frmr = array();
				$frmr['id'] = $farmer['fid'];
				$frmr['name'] = $farmer['name']. " ".$farmer['fname']; 
				$frmr['phone'] = $farmer['phone'];
				array_push($response["farmer"],$frmr);
				
			}
			$response["success"] = 1;
			$response["message"] = "Authentication successful";
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


