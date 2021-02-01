<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>AgriTech</title>
  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="style.css">

 <style>
	body{
    font-size: 1em;
	}
	.contact-form-area {
    font-size: 1.5em;
	}
	.form-control{
		font-size: 1em;
	}

</style> 
  <style>

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 200px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
   
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( !isset( $_SESSION['manager'] )  && !isset( $_SESSION['reservationAssistant'] )) {
    header("Location: index.php");
} 
?>
</head>


<body style="margin:0px; padding:0px;" >
<!-- Preloader -->
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="spinner"></div>
  </div>

  <!-- ##### Header Area Start ##### -->
  <header class="header-area">

    <!-- Navbar Area -->
    <div class="famie-main-menu">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <!-- Menu -->
          <nav class="classy-navbar justify-content-between" id="famieNav">
            <!-- Nav Brand -->
            <a href="index.php" class="nav-brand"><img src="img/core-img/logo.png" style="width:250px;height:70px;" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
              <!-- Close Button -->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>
              <!-- Navbar Start -->
              <div class="classynav">
                <ul>
                  <li ><a href="managerHome.php">Home</a></li>
                  <li ><a href="#">Reservation</a>
					<ul class="dropdown" >
                      <li ><a href="reservation.php">New</a></li>
                      <li ><a href="reservationRequests.php">Requested</a></li>
                      <li class="active"><a href="completedReservations.php"> Completed </a></li>
                    </ul>
				  </li>
				<?php if (isset( $_SESSION['manager']) ){ ?>
				   <li><a href="#">Registration</a>
                    <ul class="dropdown " style = "width: max-content" >
                      <li style = "width: 250px;" ><a href="farmerRegistration.php">Service Recipient </a></li>
                      <li style = "width: 250px;"><a href="ownerRegistration.php">Service Provider </a></li>
                      <li style = "width: 250px;"><a href="machineryRegistration.php">Machinery </a></li>
                    </ul>
                  </li>
				<?php } ?>
				 <li><a href="farmerBilling.php">Billing</a></li>
				  <li ><a href="logout.php">Log Out</a></li>
                </ul>
              </div>
              <!-- Navbar End -->
            </div>
          </nav>

          <!-- Search Form -->
        </div>
      </div>
    </div>
  </header>
  <!-- ##### Header Area End ##### -->
  <!-- ##### Hero Area Start ##### -->
  <div class="hero-area">
    <!-- ##### Card Area start ##### -->

		  </br>
		  </br>
		  </br>
	<section>
		  <div >
				<!-- Section Heading -->
				<center>
				<div class="section-heading">
				  <h2><span>Billing</span> </h2>
				</div>
				</center>
				<!-- Contact Form Area -->
				<div class="contact-form-area">
				  <form autocomplete="off" class="col-lg-8 offset-lg-2" action="#" method="post">
					
					<div class="row">
					<div class="col-sm-4 "><label for="entitySelect">Search By</label></div>
					<div  class="col-lg-8">
						<select class="form-control" id="selectValue" name="selectValue" onchange="valueSelected()" required/>
							<option value="select" >--select</option>
							<option value="All" >All</option>
							<option value="Owner" >Service Provider</option>
							<option value="Farmer" >Service Recipient</option>
						</select>
				  </div>
				  </div>
				<div class="row" id="nicRow">
					<div class="col-sm-4 "><label id="cnic" for="date">CNIC</label></div>
					  <div class="col-lg-8">
							<input type="text" class="form-control" name="CNIC" id="CNIC" placeholder="CNIC" required/>
					  </div>
                </div>
					<div class="row">
						<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="validateForm()">Search</button> </center>
					</div>
					
				  </form>
				</div>
			  </div>
	 		  
	<div id="tableDiv" >
		</br>
		<div class="contact-form-area">
		  <form autocomplete="off" class="col-lg-8 offset-lg-2" action="#" method="post">
			
			<div class="row">
			<div class="col-sm-4 "><label for="entitySelect">Sort By</label></div>
			<div  class="col-lg-8">
				<select class="form-control" id="selectValue1" name="selectValue1" required/>
					<option value="select" >--select</option>
					<option value="Area" >Actual Area Covered</option>
					<option value="Date" >Study Completion Date/Time</option>
					<option value="Location" >Location</option>
					<option value="MachineryType" >Machinery Type</option>
				</select>
		  </div>
		  </div>
		  </br>
			<div class="row">
				<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="sortTable()">Sort</button> </center>
			</div>
			
		  </form>
		</div>
		</br>
		<div class="col-lg-10 offset-lg-1">
			<table id="table" class="table table-responsive table-hover table-striped tableFixHead">
				<thead>
					<tr>
					   <th>Reservation id </th>
					   <th>Service Recipient</th>
					   <th>Service Provider</th>
					   <th>Machinery Type</th>
					   <th>Start Date/Time</th>
					   <th>End Date/Time</th>
					   <th>Request Date/Time</th>
					   <th>Study Completion Date/Time</th>
					   <th>Requested Area <small>(Acres) </small></th>
					   <th>Actual Area <small>(Hecters) </small></th>
					   <th>Validated</th>
					   <th>Bill</th>
					   <th style="display:none">Data Link</th>
					</tr>
				</thead>
				<tbody id="tableBody">
				</tbody>
			</table>
		</div>
	</section>
	</br>
		 <!-- ##### Card Area end ##### -->

<div id="map_container" >
	<div class="section-heading col-lg-8 offset-lg-2">
	  <h2><span>Activity Plot</span> </h2>
	  <div class="row">
		<div class="col-sm-3 "><label id="labeldist" for="reservationID">Reservation id</label></div>
		  <div class="col-lg-3">
			<input type="text" class="form-control" id="reservationID" name="reservationID" placeholder="" required readonly />
		  </div>
		  <div class="col-sm-3 "><label id="labeldist" for="machineryType">Machinery Type</label></div>
		  <div class="col-lg-3">
			<input type="text" class="form-control" id="machineryType" name="machineryType" placeholder="" required readonly />
		  </div>
		  
		</div>
	  <div class="row">
		<div class="col-sm-3 "><label id="labeldist" for="ActivityDuration">Activity Duration</label></div>
		  <div class="col-lg-3">
			<input type="text" class="form-control" id="activityDuration" name="activityDuration" placeholder="" required readonly />
		  </div>
		  <div class="col-sm-3 "><label id="labeldist" for="AreaCovered">Area Covered</label></div>
		  <div class="col-lg-3">
			<input type="text" class="form-control" id="areaCovered" name="areaCovered" placeholder="" required readonly />
		  </div>
		  
		</div>
	  
	  <button type="submit" class="btn famie-btn" id="simulateActivitty" onclick="simulateActivity()">Simulate Activity</button>
	
	</div>
	<div id="map_canvas" class="col-lg-8 offset-lg-2" style="width: 80%; height: 400px;"></div>
	</br>
</div>
<!--
<div id="simulateActivittyModal" class="modal" style="width: 100%; height: 600px;">
  <!-- manager Modal content -- >
  <div class="modal-content col-lg-12">
		<div class="section-heading">
			<button type="button" class="close" data-dismiss="modal" onclick="ftnCloseModalActivitySimulation()">&times;</button>
			<h2><span> Activity Simulation </span></h2>
		</div>
		
  </div>
</div>
-->

    </div>
  <!-- ##### Hero Area End ##### -->
	



  <!-- ##### All Javascript Files ##### -->
  <!-- jquery 2.2.4  -->
  <script src="js/jquery.min.js"></script>
  <!-- Popper js -->
  <script src="js/popper.min.js"></script>
  <!-- Bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Owl Carousel js -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- Classynav -->
  <script src="js/classynav.js"></script>
  <!-- Wow js -->
  <script src="js/wow.min.js"></script>
  <!-- Sticky js -->
  <script src="js/jquery.sticky.js"></script>
  <!-- Magnific Popup js -->
  <script src="js/jquery.magnific-popup.min.js"></script>
  <!-- Scrollup js -->
  <script src="js/jquery.scrollup.min.js"></script>
  <!-- Jarallax js -->
  <script src="js/jarallax.min.js"></script>
  <!-- Jarallax Video js -->
  <script src="js/jarallax-video.min.js"></script>
  <!-- Active js -->
  <script src="js/active.js"></script>
  
  <script>
	function valueSelected(){
		console.log("here1");
		var type = document.getElementById("selectValue");
		if(type.options[type.selectedIndex].text != '--select'){
			if(type.options[type.selectedIndex].text == 'All'){
				document.getElementById('nicRow').style.display="none";
			}
			else if(type.options[type.selectedIndex].text == 'Service Provider'){
				document.getElementById('nicRow').style.display="block";
			}
			else if(type.options[type.selectedIndex].text == 'Service Recipient'){
				document.getElementById('nicRow').style.display="block";
			}
		}	
	}
	//var modal = document.getElementsByClassName('modal');
	var marker = null;var marker1;var marker2;	
	function simulateActivity(){
		if(marker == null){
			var speed =1200;
			marker = new google.maps.Marker({
				title: "Activity Simulation",
				position: startlatlng,
				map: map,
				icon: "img/tractor.png"
			});
			marker1 = new google.maps.Marker({
				title: "Starting Point",
				position: startlatlng,
				map: map,
				icon: "img/blue-dot.png"
			});
			var marker1Info = new google.maps.InfoWindow({
				content: "Starting Time:  " +startTime + " \n"
			});

			google.maps.event.addListener(marker1, 'mouseover', function() {
				marker1Info.open(map, this);
			});

			google.maps.event.addListener(marker1, 'mouseout', function() {
				marker1Info.close();
			});
			animateMarker(marker, coords, speed);
			
		}
		
	}
	
function animateMarker(marker, coords, km_h)
{
    var target = 1;
    var km_h = km_h || 50;
	var delay = 50;
    function goToPoint()
    {
        var lat = marker.position.lat();
        var lng = marker.position.lng();
        var step = (km_h * 1000 * delay) / 3600000; // in meters

        var dest = coords[target];

        var distance = google.maps.geometry.spherical.computeDistanceBetween(dest, marker.position); // in meters

        var numStep = distance / step;
        var i = 0;
        var deltaLat = (coords[target][0] - lat) / numStep;
        var deltaLng = (coords[target][1] - lng) / numStep;

        function moveMarker()
        {
            lat += deltaLat;
            lng += deltaLng;
            i += step;

            if (i < distance)
            {
                marker.setPosition(new google.maps.LatLng(lat, lng));
                setTimeout(moveMarker, delay);
            }
            else
            {   marker.setPosition(dest);
                target++;
                if (target == coords.length){ 
					marker2 = new google.maps.Marker({
						title: "Ending Point",
						position: dest,
						map: map,
						icon: "img/red-dot.png"
					});
					var marker2Info = new google.maps.InfoWindow({
						content: "Ending Time:  " +endTime + " \n"
					});

					google.maps.event.addListener(marker2, 'mouseover', function() {
						marker2Info.open(map, this);
					});

					google.maps.event.addListener(marker2, 'mouseout', function() {
						marker2Info.close();
					});
					return;	 
				}

                setTimeout(goToPoint, delay);
            }
        }
        moveMarker();
    }
    goToPoint();
}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	var type = document.getElementById("selectValue");
	function validateForm(){	
		event.preventDefault();

		var nic = document.getElementById("CNIC");
		if(type.options[type.selectedIndex].text== '--select'){
			alert("Select search by option");
			type.focus();
		}
		else if(type.options[type.selectedIndex].text== 'All'){
			listAllBilling();
		}
		else if(type.options[type.selectedIndex].text== 'Service Provider'){
			if(nic.value==""){
				alert("Please enter CNIC");
				nic.focus();
			}
			else if(isNaN(nic.value)){
				alert("Invalid NIC");
				nic.focus();
			}
			else if(nic.value.length != 13){
				alert("NIC should be 13 digits");
				nic.focus();
			}
			else
				listBillingByOwner();
			
		}
		else if(type.options[type.selectedIndex].text== 'Service Recipient'){
			if(nic.value==""){
				alert("Please enter CNIC");
				nic.focus();
			}
			else if(isNaN(nic.value)){
				alert("Invalid NIC");
				nic.focus();
			}
			else if(nic.value.length != 13){
				alert("NIC should be 13 digits");
				nic.focus();
			}
			else
				listBillingByFarmer();
			
		}
	}
	
	//////////////////////////////////////////////////////////
	function sortTable(){	
		event.preventDefault();
		console.log("sort table");
		var type = document.getElementById("selectValue1");
		if(type.options[type.selectedIndex].text != '--select'){
			console.log(type.options[type.selectedIndex].text);
			if(type.options[type.selectedIndex].text == 'Actual Area Covered'){
				sortByArea();
			}
			else if(type.options[type.selectedIndex].text == 'Study Completion Date/Time'){
				sortByDate();
			}
			else if(type.options[type.selectedIndex].text == 'Location'){
				sortByLocation();
			}
			else if(type.options[type.selectedIndex].text == 'Machinery Type'){
				sortByMachineryType();
			}
		}
	}
	
	var reservations = [];
	function sortByArea(){
		console.log("sort by area ");
		reservations.sort(GetSortOrder("actual_area"));
		console.log(reservations);
		populateTable(reservations);
	}	
	function sortByDate(){
		reservations.sort(GetSortOrder("study_completion_time"));
		console.log(reservations);
		populateTable(reservations);
	}	
	function sortByLocation(){
		
	}	
	function sortByMachineryType(){
		reservations.sort(GetSortOrder("machineType"));
		console.log(reservations);
		populateTable(reservations);
	}
	function GetSortOrder(prop) {  
		return function(a, b) {
			if(prop == "actual_area"){			
				if (parseFloat(a[prop])< parseFloat(b[prop])) {  
					return 1;  
				} else if (parseFloat(a[prop])> parseFloat(b[prop])) {  
					return -1;  
				}  
			}
			else if(prop == "study_completion_time"){			
				var x = new Date(a.study_completion_time);
				var y = new Date(b.study_completion_time);
				return y - x;
			}
			else if(prop == "machineType"){			
				var x = a.machineType.toUpperCase(),
					y = b.machineType.toUpperCase();
				if (x > y) {
					return 1;
				}
				if (x < y) {
					return -1;
				}
			}
			return 0;  
		}  
	} 
	 
	
	
	//////////////////////////////////////////////////////////
	
	
	
	function listAllBilling(){
		$("#table tbody tr").remove();
		document.getElementById('tableDiv').style.display="none";
		$.ajax({
			url:'listAllBilling.php',
			method:'POST',
			dataType: 'json',
			success:function(response){
				console.log('abc1');
				if(response.success == 1){
					populateTable(response.reservations);
				}
				else{
					alert(response.message);
				}
			},
			 error:function(xhr, textStatus, errorThrown) {
				alert("Error: "+xhr.responseText);
			}
		});
	
	}
		function listBillingByOwner(){
		$("#table tbody tr").remove();
		document.getElementById('tableDiv').style.display="none";
		var cnic = document.getElementById("CNIC");
		$.ajax({
			url:'listBillingByOwner.php',
			method:'POST',
			data:{
				'nic':cnic.value,			
			},
			dataType: 'json',
			success:function(response){
				console.log('abc1');
				if(response.success == 1){
					populateTable(response.reservations);
				}
				else{
					alert(response.message);
				}
			},
			 error:function(xhr, textStatus, errorThrown) {
				alert("Error: "+xhr.responseText);
			}
		});
	
	}
		function listBillingByFarmer(){
		$("#table tbody tr").remove();
		document.getElementById('tableDiv').style.display="none";
		var cnic = document.getElementById("CNIC");
		$.ajax({
			url:'listBillingByFarmer.php',
			method:'POST',
			data:{
				'nic':cnic.value,			
			},
			dataType: 'json',
			success:function(response){
				console.log('abc1');
				if(response.success == 1){
					populateTable(response.reservations);
				}
				else{
					alert(response.message);
				}
			},
			 error:function(xhr, textStatus, errorThrown) {
				alert("Error: "+xhr.responseText);
			}
		});
	
	}
	
	function populateTable(obj){
	 $("#table tbody tr").remove(); 
	if(obj.length > 0){
		reservations = obj;
		document.getElementById('tableDiv').style.display="block";
		document.getElementById("tableDiv").focus();
		$('html, body').animate({scrollTop: $("#tableDiv").offset().top}, 'slow');
		console.log("populate table here");
		//console.log(obj.length);
		var i;	
		var row  = '';
		for(i=0 ; i < obj.length; i++){
			//console.log("i" + i);
			$('#table').append('<tr style="cursor: pointer;" id='+obj[i].id+ '><td class="item-rid">'+ obj[i].rid+'</td><td class="item-farmer">'+obj[i].FarmerName+" " + obj[i].FarmerLastName+'</td><td class="item-owner">'+obj[i].OwnerName+ " "+obj[i].OwnerLastName +'</td><td class="item-machineType">'+obj[i].machineType+'</td><td class="item-sdate" >'+obj[i].start_date+'</td><td class="item-edate">'+obj[i].end_date+'</td><td class="item-request_date">'+obj[i].request_date+'</td><td class="item-study_completion_time">'+obj[i].study_completion_time+'</td><td class="item-area">'+obj[i].area_requested+'</td><td class="item-actual_area">'+(parseFloat(obj[i].actual_area)/4046).toFixed(2)+'</td><td class="item-area">'+obj[i].authenticity+'</td><td style ="word-break:break-all;display:none" class="item-data_link">'+obj[i].data_link+'</td><td class="item-Bill">'+obj[i].BillAmount+'</td></tr>');
		}
	}
	else{
		alert("No machine available currently near you");
	}
}

$("#table").on('click','tr',function(e) { 
	
	var url = $(this).find('.item-data_link').text();
	let startDate = $(this).find('.item-sdate').text();
	let endDate = $(this).find('.item-edate').text();
	var d1 = new Date (startDate);
	var d2 = new Date (endDate);
	var duration = Math.abs(d1 - d2) / 36e5;

	document.getElementById('reservationID').value = $(this).find('.item-rid').text();
	document.getElementById('areaCovered').value = $(this).find('.item-actual_area').text() + " Acres";
	document.getElementById('machineryType').value = $(this).find('.item-machineType').text();
	document.getElementById('activityDuration').value = duration + " hour(s)";
//	var url= 'https://agritechstorage.s3.amazonaws.com/Sandbox/fullApptesting/'+rid+'.csv';
	//console.log(url);
	document.getElementById('map_container').style.display="block";
	coords = null;
	coords = [];
	drawMap(url);
	
	
}); 

	
  </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl-N13dPLykJG9rBZKUBjpeyY_i5dWoc0&libraries=geometry"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-csv@1.0.2/src/jquery.csv.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById('nicRow').style.display="none";
		document.getElementById('tableDiv').style.display="none";
		document.getElementById('map_container').style.display="none";
	});
</script>  
<script type="text/javascript">
var coord ;
var map;
var coords = [];
var startlatlng; 
var centerlatlng;
var startTime; var endTime;

function drawMap(url) {
	console.log(url);
	if(marker != null){
		marker.setMap(null);
		marker1.setMap(null);
		marker2.setMap(null);
		marker = null;
		marker1 = null;
		marker2 = null;
	}
	var latlngbounds = new google.maps.LatLngBounds();
	//var url= 'https://agritechstorage.s3.amazonaws.com/Sandbox/fullApptesting/'+63+'.csv';
	$.ajax({
	url:url ,
	async: false,
	success: function (csvd) {
		data = $.csv.toObjects(csvd);
	
	},
	dataType: "text",
	complete:     function handleFileSelect() {
		mydata = data;
		validate(mydata);
		for(var row in data) {
			//console.log(data[row]["Latitude"]);
			//console.log(data[row]["Longitude"]);
			coord = new google.maps.LatLng(parseFloat(data[row]["Latitude"]), parseFloat(data[row]["Longitude"]));
			coords.push(coord); 
			latlngbounds.extend(coord);
		}
		//console.log(coords);
		startTime = data[0]["DateAndTime"];
		endTime = data[data.length-1]["DateAndTime"];
		centerlatlng = coords[data.length/2];
		startlatlng = coords[0];
		var myOptions = {
			zoom: 20,
			center: centerlatlng,
			mapTypeId: google.maps.MapTypeId.SATELLITE
		};
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		map.fitBounds(latlngbounds);
		var polygon = new google.maps.Polygon({
		clickable: false,
		geodesic: true,
		paths: coords,
		strokeColor: "#0000FF",
		strokeOpacity: 1.000000,
		strokeWeight: 1
		});
		var polyline = new google.maps.Polyline({
          path: coords,
          geodesic: true,
          strokeColor: '#0000FF',
          strokeOpacity: 1.0,
          strokeWeight: 1
        });
		
		polyline.setMap(map);
		$('html, body').animate({scrollTop: $("#map_canvas").offset().top}, 'slow');
		//alert((google.maps.geometry.spherical.computeArea(polygon.getPath()).toFixed(2))/4046.856);

	}
	});

	
}
function getDistanceInMeters(location1, location2) {
    var lat1 = location1.lat();
    var lon1 = location1.lng();

    var lat2 = location2.lat();
    var lon2 = location2.lng();

    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);
    var dLon = deg2rad(lon2 - lon1);
    var a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return (d * 1000);
}
    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

function validate(data){
	//console.log(typeof data[0].DateandTime);
	//var vArray = [];
	for(i=0;i<data.length;i++){
		if(data[i].DateandTime == "undefined"){
			data.splice(i,1);
			i--;
			console.log('do i came here?');
		}
		else if(data[i].z1 == "undefined"){
			data.splice(i,1);
			i--;
			//console.log('do i came here?');
		}
		else if(data[i].latitude =="0"){
			data.splice(i,1);
			i--;
		}
		else if(data[i].z2 =="undefined"){
			data.splice(i,1);
			i--;
		}
		else if(data[i].longitude =='0'){
			data.splice(i,1);
			i--;
		}

		
	}	
}



</script>

</body>

</html>

