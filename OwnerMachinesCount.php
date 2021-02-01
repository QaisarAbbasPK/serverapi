<?php
include("config.php");
// array for JSON response
$response   = array();
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("OOPs something went wrong");
}

if (isset($_GET['cnic']) ) {
	$ownerCNIC = $_GET['cnic'];
	$machinery = array("Leveler", "Rotavator", "Cultivator", "Disc Harrow", "Rice Harvester"); 
	$machineryURL = array("https://aicontents.s3.amazonaws.com/ServiceProviderAppData/machinesImages/leveler.jpg","https://aicontents.s3.amazonaws.com/ServiceProviderAppData/machinesImages/Rotavator.png","https://aicontents.s3.amazonaws.com/ServiceProviderAppData/machinesImages/Cultivator.png","https://aicontents.s3.amazonaws.com/ServiceProviderAppData/machinesImages/Disc_Harrow.png","https://aicontents.s3.amazonaws.com/ServiceProviderAppData/machinesImages/Rice_Harvester.png");
	$sql1 = 'SELECT oid FROM Owner WHERE  nic = :ownerCNIC';
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':ownerCNIC', $ownerCNIC, PDO::PARAM_STR);
	$stmt1->execute();
	if ($stmt1->rowCount()){
		$response["success"] = 1;
		$response["MachineryCount"] = array();
		foreach($stmt1 as $owner){
			$ownerID = $owner['oid'];
		}	
		$i = 0;
		foreach($machinery as $type){
			$machine = array();
			$sql = 'SELECT COUNT(*) AS count FROM Machinery where owner_id= :ownerID AND type= :type';
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':ownerID', $ownerID, PDO::PARAM_STR);
			$stmt->bindParam(':type', $type, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$machine['name'] = $type;
			$machine['url'] = $machineryURL[$i];
			$i++;
			$machine['count'] = intval ($row['count']);
			array_push($response["MachineryCount"], $machine);
		}
	}
	else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "Service Provider's CNIC is not registered";
		// echo no users JSON
	}
	
	
    
}

else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "Required fields missing...";
}
echo json_encode($response); 

?>


