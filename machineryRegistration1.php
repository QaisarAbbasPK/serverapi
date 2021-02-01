<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>AgriTech</title>
  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <!-- Core Stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="jquery.datetimepicker.css">
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
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( !isset( $_SESSION['manager'] ) && !isset( $_SESSION['registrationAssistant'] )  ) {
    header("Location: index.php");
} 
?>
</head>


<body>
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
			  <?php if (isset( $_SESSION['manager']) ){ ?>
				  <li ><a href="#">Reservation</a>
					<ul class="dropdown" >
                      <li ><a href="reservation.php">New</a></li>
                      <li ><a href="reservationRequests.php">Requested</a></li>
                      <li ><a href="completedReservations.php"> Completed </a></li>
                    </ul>
				  </li>
			  <?php } ?>
				  <li ><a href="#">Registration</a>
                    <ul class="dropdown " style = "width: max-content" >
                      <li style = "width: 250px;" ><a href="farmerRegistration.php">Service Recipient </a></li>
                      <li style = "width: 250px;"><a href="ownerRegistration.php">Service Provider </a></li>
                      <li class="active"  style = "width: 250px;"><a href="machineryRegistration.php">Machinery </a></li>
                    </ul>
                  </li>
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
  
  <!-- ##### Card Area start ##### -->

  </br>
  </br>
  </br>
<section>
<div >
	<!-- Section Heading -->
	<center>
	<div class="section-heading">
	  <h2><span>Machinery Registration</span> </h2>
	</div>
	
	<div class="contact-form-area" id="mainview">
	</div>
	</center>
	<!-- Contact Form Area -->
	<div class="contact-form-area" id="1">
	  <form id="form1" autocomplete="off" class="col-lg-8 " action="#" method="post">
		<div class="row">
		<div class="col-sm-6 "><label for="cnic">Service Provider's CNIC</label></div>
		  <div class="col-sm-6">
			<input type="text" class="form-control" id="CNIC" name="CNIC" placeholder="Service Provider's CNIC" required/>
		  </div>
		</div>
		
					
		<div class="row">
			<div class="col-sm-6 "><button type="submit" class="btn famie-btn" id="searchbtn" onclick="validateCNIC()">Check</button> </div>
		</div>
		
	  </form>
	</div>
	<div class="contact-form-area" id="2">
	Select Machinery Type
	</br></br>
	<form id="form2" autocomplete="off" class="col-lg-10 offset-lg-1" action="#" method="post">
		
		<div class="cc-selector-2">
			<input checked="checked" id="leveler" type="radio" name="machineryType" value="Leveler" />
			<label class="drinkcard-cc leveler" for="leveler"></label>
			<input   id="cultivator" type="radio" name="machineryType" value="Cultivator" />
			<label class="drinkcard-cc cultivator"for="cultivator"></label>
			<input id="rotavator" type="radio" name="machineryType" value="Rotavator" />
			<label class="drinkcard-cc rotavator" for="rotavator"></label>
			<input  id="diskHarrow" type="radio" name="machineryType" value="Disk Harrow" />
			<label class="drinkcard-cc diskHarrow"for="diskHarrow"></label>
			<input id="riceHarvester" type="radio" name="machineryType" value="Rice Harvester" />
			<label class="drinkcard-cc riceHarvester"for="riceHarvester"></label>
		</div>
		<div class="row">
				<div class="sol-sm-6"> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="getOtherFields()">Next</button> </div>
		</div>
		
	</form>
	</div>
	<div class="contact-form-area" id="3">
		<form id="form3" autocomplete="off" class="col-lg-8 offset-lg-2" action="#" method="post">
            <div class="row">
			<div class="col-sm-6 "><label for="regno">Reg#</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="regno" name="regno" placeholder="Registration Number" required/>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-6 "><label for="make">Make</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="make" name="make" placeholder="Make" required/>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-6 "><label for="model">Model</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="model" name="model" placeholder="Model" required/>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-6 "><label for="length">Length(m)</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="length" name="length" placeholder="Length" required/>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-6 "><label for="width">Width(m)</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="width" name="width" placeholder="Width" required/>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-6 "><label for="height">Height(m)</label></div>
			  <div class="col-lg-6">
				<input type="text" class="form-control" id="height" name="height" placeholder="Height" required/>
			  </div>
			</div>				
			<div class="row">
				<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="validateForm()">Register</button> </center>
			</div>
			
		  </form>
	</div>
	
	<div class="contact-form-area" id="4">
		<center> Service provide not registered yet. Please, Enter Service Provider's information first.</center></br>
		<form id="form4" autocomplete="off" class="col-lg-8 offset-lg-2" action="#" method="post">
                <div class="row">
				<div class="col-sm-4 "><label for="fname">First Name</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required/>
                  </div>
                </div>
				<div class="row">
				<div class="col-sm-4 "><label for="lastName">Last Name</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="LastName" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="CNIC">CNIC</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="CNIC" name="CNIC" placeholder="CNIC" required/>
                  </div>
                </div>
				<div class="row">
				<div class="col-sm-4 "><label for="address">Address</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="address" name="address" placeholder="address" required/>
                  </div>
                </div>
				<div class="row">
				<div class="col-sm-4 "><label for="Tehsil">Tehsil</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="tehsil" name="tehsil" placeholder="Tehsil" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="District">District</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="district" name="district" placeholder="District" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="phone">Phone</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="password">Password</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="levelerCount">Levelers Count</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="levelerCount" name="levelerCount" placeholder="0" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="cultivatorCount">Cultivators Count</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="cultivatorCount" name="cultivatorCount" placeholder="0" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="rotavatorCount">Rotavators Count</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="rotavatorCount" name="rotavatorCount" placeholder="0" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="discHarrowCount">Disc Harrows Count</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="discHarrowCount" name="discHarrowCount" placeholder="0" required/>
                  </div>
				</div>
				<div class="row">
				<div class="col-sm-4 "><label for="riceHarvesterCount">Rice Harvester Count</label></div>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="riceHarvesterCount" name="riceHarvesterCount" placeholder="0" required/>
                  </div>
				</div>
				<div class="row">
					<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="validateOwner()">Register</button> </center>
                </div>
				
              </form>
	</div>
	<div class="contact-form-area" id="5">
		<div class="col-lg-8 offset-lg-2">
			Add another machinery for this owner?
			<div class="row offset-lg-3"> 
				<div class="col-lg-2">
					<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="addAnotherMachinery()">Yes</button> </center>
				</div>
				<div class="col-lg-2 offset-lg-1">
					<center> <button type="submit" class="btn famie-btn" id="searchbtn" onclick="no()">No</button> </center>
				</div>
			</div>
		</div>
	</div>
</div>
		  

</section>

 <!-- ##### Card Area end ##### -->
 
  



  <!-- ##### All Javascript Files ##### -->
  <!-- jquery datetimepicker   
  <script src="jquery.js"></script>
  <script src="jquery.datetimepicker.full.js"></script>
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
  <!-- ajax query -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  
  <script type="text/javascript"> 
  var cnic, machineryType;

  function validateCNIC(){	
		event.preventDefault();
		cnic = document.getElementById("CNIC");
		
		if(cnic.value==""){
			alert("Please enter Owner's CNIC.");
			cnic.focus();
		}
		else if(cnic.value==""){
			alert("Please enter CNIC.");
			cnic.focus();
		}
		else if(isNaN(cnic.value)){
			alert("NIC Format Invalid. ");
			cnic.focus();
		}
		else if(cnic.value.length != 13){
			alert("CNIC should be 13 digits.");
			cnic.focus();
		}
		else{
			checkOwner(cnic.value);
		}
	}



function checkOwner(cnic){
		event.preventDefault();		
		$.ajax({
			url:'checkOwner.php',
			method:'GET',
			data:{
				'cnic':cnic				
				},
			dataType: 'json',
			success:function(response){
				//console.log('abc');
				if(response.success == 1){
					//alert(response.Owner);
					console.log(Response);
					document.getElementById("1").display = "none";
					document.getElementById("2").display = "block";
					document.getElementById('mainview').innerHTML = document.getElementById("2").innerHTML;
					//here display registration block for machinery
					//location.href='managerHome.php'	
				}
				else{
					//here display registration block for owner
					document.getElementById("1").display = "none";
					document.getElementById("4").display = "block";
					document.getElementById('mainview').innerHTML = document.getElementById("4").innerHTML;
				}
			},
			 error:function(xhr, textStatus, errorThrown) {
				alert("Error: "+xhr.responseText);
			}
		});
}

function getOtherFields(){
	event.preventDefault();
	machineryType = document.querySelector('input[name="machineryType"]:checked').value;
	console.log(machineryType);
	document.getElementById("2").display = "none";
	document.getElementById("3").display = "block";
	document.getElementById('mainview').innerHTML = document.getElementById("3").innerHTML;
  
}

function validateForm(){	
	event.preventDefault();
	var regno = document.getElementById("regno");
	var make = document.getElementById("make");
	var model = document.getElementById("model");	
	var length = document.getElementById("length");	
	var width = document.getElementById("width");	
	var height = document.getElementById("height");	
	if(regno.value==""){
		alert("Please enter registration number.");
		regno.focus();
	}
	else if(make.value==""){
		alert("Please enter make of machine.");
		make.focus();
	}
	else if(model.value==""){
		alert("Please enter machine model");
		model.focus();
	}
	else if(length.value==""){
		alert("Please enter machine length");
		length.focus();
	}
	else if(width.value==""){
		alert("Please enter machine width");
		width.focus();
	}
	else if(height.value==""){
		alert("Please enter machine height");
		height.focus();
	}
	else{
		machineryRegistration();
	}
}

function machineryRegistration(){
	event.preventDefault();
	var regno = document.getElementById("regno").value;
	var make = document.getElementById("make").value;
	var model = document.getElementById("model").value;	
	var length = document.getElementById("length").value;	
	var width = document.getElementById("width").value;	
	var height = document.getElementById("height").value;		
	//console.log(startDate);

	$.ajax({
		url:'registerMachine.php',
		method:'POST',
		data:{
			'CNIC':cnic.value,
			'type':machineryType,
			'regno':regno,
			'make':make,
			'model':model,
			'length':length,
			'width':width,
			'height':height,
			
			},
		dataType: 'json',
		success:function(response){
			//console.log('abc');
			if(response.success == 1){
				alert(response.message);
				document.getElementById("3").display = "none";
				document.getElementById("5").display = "block";
				document.getElementById('mainview').innerHTML = document.getElementById("5").innerHTML;
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

function validateOwner(){	
		event.preventDefault();
		var fname = document.getElementById("firstName");
		var lname = document.getElementById("lastName");
		var cnic = document.getElementById("CNIC");
		var address = document.getElementById("address");
		var phone = document.getElementById("phone");	
		var tehsil = document.getElementById("tehsil");	
		var district = document.getElementById("district");	
		var levelerCount = document.getElementById("levelerCount");	
		var cultivatorCount = document.getElementById("cultivatorCount");	
		var rotavatorCount = document.getElementById("rotavatorCount");	
		var discHarrowCount = document.getElementById("discHarrowCount");	
		var riceHarvesterCount = document.getElementById("riceHarvesterCount");	
		var password = document.getElementById("password");	
		if(fname.value==""){
			alert("Please enter First Name.");
			fname.focus();
		}
		else if(lname.value==""){
			alert("Please enter Last Name.");
			lname.focus();
		}
		else if(cnic.value==""){
			alert("Please enter CNIC.");
			cnic.focus();
		}
		else if(isNaN(cnic.value)){
			alert("NIC Format Invalid. ");
			cnic.focus();
		}
		else if(cnic.value.length != 13){
			alert("CNIC should be 13 digits.");
			cnic.focus();
		}
		else if(address.value==""){
			alert("Please enter address.");
			address.focus();
		}
		else if(phone.value==""){
			alert("Please enter phone no.");
			phone.focus();
		}
		else if(tehsil.value==""){
			alert("Please enter tehsil.");
			tehsil.focus();
		}
		else if(district.value==""){
			alert("Please enter district.");
			district.focus();
		}
		else if(levelerCount.value==""){
			alert("Please enter Leveler Count.");
			levelerCount.focus();
		}
		else if(cultivatorCount.value==""){
			alert("Please enter Cultivator Count.");
			cultivatorCount.focus();
		}
		else if(rotavatorCount.value==""){
			alert("Please enter Rotavator Count.");
			rotavatorCount.focus();
		}
		else if(discHarrowCount.value==""){
			alert("Please enter Disc Harrow Count.");
			discHarrowCount.focus();
		}
		else if(riceHarvesterCount.value==""){
			alert("Please enter Rice Harvester Count.");
			riceHarvesterCount.focus();
		}
		else if(password.value==""){
			alert("Please enter password.");
			password.focus();
		}
		else{
			ownerRegistration();
		}
	}



function ownerRegistration(){
		event.preventDefault();
		var fname = document.getElementById("firstName").value;
		var lname = document.getElementById("lastName").value;
		var cnic = document.getElementById("CNIC").value;
		var address = document.getElementById("address").value;
		var phone = document.getElementById("phone").value;
		var tehsil = document.getElementById("tehsil").value;	
		var district = document.getElementById("district").value;	
		var levelerCount = document.getElementById("levelerCount").value;	
		var cultivatorCount = document.getElementById("cultivatorCount").value;	
		var rotavatorCount = document.getElementById("rotavatorCount").value;	
		var discHarrowCount = document.getElementById("discHarrowCount").value;	
		var riceHarvesterCount = document.getElementById("riceHarvesterCount").value;	
		var password = document.getElementById("password").value;	
		//console.log(startDate);
		
		$.ajax({
			url:'registerOwner.php',
			method:'POST',
			data:{
				'firstName':fname,
				'lastName':lname,
				'CNIC':cnic,
				'address': address,
				'phone' : phone,
				'gis_location_lat' : 0,
				'gis_location_lng' : 0,
				'tehsil' : tehsil,
				'district' : district,
				'levelerCount' : levelerCount,
				'cultivatorCount' : cultivatorCount,
				'rotavatorCount' : rotavatorCount,
				'discHarrowCount' : discHarrowCount,
				'riceHarvesterCount' : riceHarvesterCount,
				'password' : password
				
				
				},
			dataType: 'json',
			success:function(response){
				//console.log('abc');
				if(response.success == 1){
					alert(response.message);
					document.getElementById("4").display = "none";
					document.getElementById("2").display = "block";
					document.getElementById('mainview').innerHTML = document.getElementById("2").innerHTML;
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

function addAnotherMachinery (){
	document.getElementById('form2').reset();
	document.getElementById('form3').reset();
	document.getElementById("5").display = "none";
	document.getElementById("2").display = "block";
	document.getElementById('mainview').innerHTML = document.getElementById("2").innerHTML;
}

function no(){
	location.href='machineryRegistration1.php'
}
</script>

<script>
	$(document).ready(function(){		
	document.getElementById('mainview').innerHTML = document.getElementById("1").innerHTML;
	document.getElementById('1').style.display="none";
	document.getElementById('2').style.display="none";
	document.getElementById('3').style.display="none";
	document.getElementById('4').style.display="none";
	document.getElementById('5').style.display="none";
		
	});
</script>       
  

</body>

</html>
