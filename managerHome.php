<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>AgriTech Manager</title>
  <!-- Favicon -->
  <link rel="icon" href="img/core-img/favicon.ico">
  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="style.css">

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

if ( !isset( $_SESSION['manager'] ) ) {
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
                  <li class="active"><a href="managerHome.php">Home</a></li>
                  <li ><a href="#">Reservation</a>
					<ul class="dropdown" >
                      <li ><a href="reservation.php">New</a></li>
                      <li ><a href="reservationRequests.php">Requested</a></li>
                      <li ><a href="completedReservations.php"> Completed </a></li>
                    </ul>
				  </li>
				  <li><a href="#">Registration</a>
                    <ul class="dropdown " style = "width: max-content" >
                      <li style = "width: 250px;" ><a href="farmerRegistration.php">Service Recipient </a></li>
                      <li style = "width: 250px;"><a href="ownerRegistration.php">Service Provider </a></li>
                      <li style = "width: 250px;"><a href="machineryRegistration.php">Machinery </a></li>
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
  <!-- ##### Hero Area Start ##### -->
  <div class="hero-area">
    <!-- ##### Card Area start ##### -->

		  </br>
		  </br>
		  </br>
	<div class="col-lg-8 offset-lg-1">
		<div class="section-heading">
		  <h2><span>Summary Dashboard</span> </h2>
		</div>
		<div class="container h-100">
		  <div class="row h-100 align-items-center">
			<div class="col-12 col-lg-10">
			  <div class="welcome-content">
				<div class="card" style="width:50rem;">
				  <div class="card-body">
					<div class="section-heading">
						<h5 class="card-title"><span> Registered Machineries</span></h5>
					</div>
					<table id="table" class="table table-responsive table-striped table-hover tableFixHead">
						<thead>
							<tr>
							   <th>Total Count</th>
							   <th>Levelers</th>
							   <th>Rotavators</th>
							   <th>Cultivators</th>
							   <th>Disc Harrows</th>
							</tr>
						</thead>
						<tbody id="tableBody">
						</tbody>
					</table>
				  </div>
					
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="container h-100">
		  <div class="row h-100 align-items-center">
			<div class="col-12 col-lg-10">
			  <div class="welcome-content">
				<div class="card" style="width:50rem;">
				  <div class="card-body">
					<div class="section-heading">
						<h5 class="card-title"><span> Activity Details</span></h5>
					</div>
					<table id="table1" class="table table-responsive table-striped table-hover tableFixHead">
						<thead>
							<tr>
							   <th>Jobs Completed</th>
							   <th>Hours/Acres Completed</th>
							   <th>Jobs in Queue</th>
							   <th>Hours/Acres Remaining</th>
							</tr>
						</thead>
						<tbody id="tableBody1">
						</tbody>
					</table>
				  </div>
					
				</div>
			  </div>
			</div>
		  </div>
		</div>
		
	</div>
		 <!-- ##### Card Area end ##### -->



    </div>
  <!-- ##### Hero Area End ##### -->
  
<!-- jquery 2.2.4  -->
  <script src="js/jquery.min.js"></script>
 
  <script>
		$(document).ready(function(){
			//document.getElementById('farmerName').style.display="none";
			//var nic = document.getElementById("farmerNIC");
			retrieveData();
			
		});
		
		function retrieveData(){
		//var nic = document.getElementById("farmerNIC").value;
		//var type = document.getElementById("machineType");
		//var machineType = type.options[type.selectedIndex].text;
		//startDate = document.getElementById("startDate").value;
		//endDate = document.getElementById("endDate").value;
		$.ajax({
			url:'getMachineCount.php',
			method:'POST',
			data:{
							
			},
			dataType: 'json',
			success:function(response){
				console.log('abc1');
				if(response.success == 1){
					//document.getElementById('labeln').style.display="block";
					//document.getElementById('labelln').style.display="block";
					//document.getElementById('farmerName').style.display="block";
					//document.getElementById('searchbtn').style.display="none";
					//document.getElementById('tableDiv').style.display="block";
					//document.getElementById('farmerName').value=response.farmer[0].name+" "+response.farmer[0].fname;
					//document.getElementById('farmerLname').value=response.farmer[0].fname;
					//farmerID=response.farmer[0].name;
					//populateTable(response.owner);
					//console.log(response.farmer[0].name);
					//farmerID =  response.farmer[0].id;
					//console.log(response.owner.length);
					$('#table').append('<tr style="cursor: pointer;" ><td >'+ response.totalCount+'</td><td >'+response.levelerCount+'</td><td >'+response.rotavatorCount+'</td><td >'+response.cultivatorCount+'</td><td >'+response.discHarrowCount+'</td></tr>');
					$('#table1').append('<tr style="cursor: pointer;" ><td >'+ response.jobsCompleted+'</td><td >'+response.hoursCompleted+"/"+response.acresCompleted+'</td><td >'+response.jobsInQueue+'</td><td >'+response.hoursRemaining+"/"+response.acresRemaining+'</td></tr>');
					//alert(response.totalCount + " "+response.cultivatorCount + " " + response.levelerCount+ " " + response.rotavatorCount + " " + response.discHarrowCount);
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
		
		
	</script>



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


</body>

</html>
