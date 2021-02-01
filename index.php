<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Title -->
  <title>AgriTech Login Page</title>
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
session_start();

if ( isset( $_SESSION['manager'] ) ) {
    header("Location: managerHome.php");
}
if ( isset( $_SESSION['reservationAssistant'] ) ) {
    header("Location: reservationAssistantHome.php");
}
if ( isset( $_SESSION['registrationAssistant'] ) ) {
    header("Location: registrationAssistantHome.php");
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
    <!-- Top Header Area -->
    <div class="top-header-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="top-header-content d-flex align-items-center justify-content-between">
              <!-- Top Header Content -->
              <div class="top-header-meta">
                <h6>Welcome to <span style="color:#77b122;">Hal Chal</span>, making the Agriculture smart.<h6>
              </div>
              <!-- Top Header Content -->
              <div class="top-header-meta text-right">
                <a href="#" data-toggle="tooltip" data-placement="bottom" title=""><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Email: iinfo.agritech@gmail.com</span></a>
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="asd"><i class="fa fa-phone" aria-hidden="true"></i> <span>Call Us: 1234567890</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
                  <li class="active"><a href="javascript:ftnManagerModal();">Manager</a></li>
                  <li class="active"><a href="javascript:ftnReservationAssisstantModal();" >Reservation</a></li>
                  <li class="active"><a href="javascript:ftnRegistrationAssisstantModal();" >Registration</a></li>
				  

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
    <div class="welcome-slides owl-carousel">

      <!-- Single Welcome Slides -->
      <div class="single-welcome-slides bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/1.jpg);">
        <div class="container h-100">
          <div class="row h-100 align-items-center">
            <div class="col-12 col-lg-10">
              <div class="welcome-content">
                <h2 data-animation="fadeInUp" data-delay="200ms">Welcome to Hal Chal</h2>
                <p data-animation="fadeInUp" data-delay="400ms" style="font-size:20px;"> We provide agricultural services countrywide.</p>
                <a href="comingSoon.html" class="btn famie-btn mt-4" data-animation="bounceInUp" data-delay="600ms">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Single Welcome Slides -->
      <div class="single-welcome-slides bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/2.jpg);">
        <div class="container h-100">
          <div class="row h-100 align-items-center">
            <div class="col-12 col-lg-10">
              <div class="welcome-content">
                <h2 data-animation="fadeInUp" data-delay="200ms">Welcome to Hal Chal</h2>
                <p data-animation="fadeInUp" data-delay="400ms" style="font-size:20px;"> We provide agricultural services countrywide.</p>
                <a href="comingSoon.html" class="btn famie-btn mt-4" data-animation="bounceInUp" data-delay="600ms">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Single Welcome Slides -->
      <div class="single-welcome-slides bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/3.jpg);">
        <div class="container h-100">
          <div class="row h-100 align-items-center">
            <div class="col-12 col-lg-10">
              <div class="welcome-content">
                <h2 data-animation="fadeInUp" data-delay="200ms">Welcome to Hal Chal</h2>
                <p data-animation="fadeInUp" data-delay="400ms" style="font-size:20px;"> We provide agricultural services countrywide.</p>
                <a href="comingSoon.html" class="btn famie-btn mt-4" data-animation="bounceInUp" data-delay="600ms">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- ##### Hero Area End ##### -->

  <!-- Contact Form Area -->
  <!-- The Modal -->
<div id="managerModal" class="modal">
  <!-- manager Modal content -->
  <div class="modal-content col-lg-6">
    <form action="managerLogin.php"  class="contact-form-area">
      <div class="section-heading">
		<button type="button" class="close" data-dismiss="modal" onclick="ftnCloseModalManager()">&times;</button>
        <h2><span> Login To Manager Panel </span></h2>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label  for="Lemail">Email</label></div>
		<div class="col-lg-8">
			<input type="email" class="form-control" name="email" placeholder="Email" required />
		</div>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label for="password">Password</label></div>
		<div class="col-lg-8">
			<input type="password" class="form-control" name="pwd" placeholder="Password" required />
		</div>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn famie-btn" style="text-transform: none;">Login</button>
      </div>

    </form>
  </div>
</div>

<div id="reservationAssisstantModal" class="modal">
  <!-- reservationAssisstant Modal content -->
  <div class="modal-content col-lg-6">
    <form action="reservationAssistantLogin.php" class="contact-form-area">
      <div class="section-heading">
		 <button type="button" class="close" data-dismiss="modal" onclick="ftnCloseModalResAst()">&times;</button>
        <h2><span> Login To Reservation Panel</span></h2>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label  for="Lemail">Email</label></div>
		<div class="col-lg-8">
			<input type="email" class="form-control" name="email" placeholder="Email" required />
		</div>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label for="password">Password</label></div>
		<div class="col-lg-8">
			<input type="password" class="form-control" name="pwd" placeholder="Password" required />
		</div>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn famie-btn" style="text-transform: none;">Login</button>
      </div>

    </form>
  </div>
</div>
<div id="registrationAssisstantModal" class="modal">
  <!-- registrationAssisstant Modal content -->
  <div class="modal-content col-lg-6">
    <form action="registrationAssistantLogin.php" class="contact-form-area">
      <div class="section-heading">
		 <button type="button" class="close" data-dismiss="modal" onclick="ftnCloseModalRegAst()">&times;</button>
        <h2><span>Login To Registration Panel</span></h2>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label  for="Lemail">Email</label></div>
		<div class="col-lg-8">
			<input type="email" class="form-control" name="email" placeholder="Email" required />
		</div>
      </div>
      <div class="row">
		<div class="col-sm-4 "><label for="password">Password</label></div>
		<div class="col-lg-8">
			<input type="password" class="form-control" name="pwd" placeholder="Password" required />
		</div>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn famie-btn" style="text-transform: none;">Login</button>
      </div>

    </form>
  </div>
</div>




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


<!-- ##### All Javascript Functions ##### -->
  <script>
    // Get the <span> element that closes the modal
  var modal = document.getElementsByClassName('modal');
  function ftnManagerModal() {
    modal[0].style.display = "block";
  }
  function ftnReservationAssisstantModal() {
    modal[1].style.display = "block";
  }
  function ftnRegistrationAssisstantModal() {
    modal[2].style.display = "block";
  }

  window.onclick = function(event) {
    if (event.target == modal[0]) {
      modal[0].style.display = "none";
    }
    if (event.target == modal[1]) {
      modal[1].style.display = "none";
    }
    if (event.target == modal[2]) {
      modal[2].style.display = "none";
    }
	
  }
  function ftnCloseModalManager(){
		modal[0].style.display = "none";
	}
	function ftnCloseModalResAst(){
		modal[1].style.display = "none";
	}
	function ftnCloseModalRegAst(){
		modal[2].style.display = "none";
	}
  </script>

<!-- ##### All Javascript Functions end ##### -->
</body>

</html>
