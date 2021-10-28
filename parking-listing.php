<?php
	session_start();
	require "dbconfig/config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>GoWhereParkCheap</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
<?php 
		include("navbar.php"); 
		?>


     <section>
          <div class="container">
               <div class="text-center">
                    <h1>Parking Listing</h1>

               <?php
			// fill in the blanks
			$place = $location = $type = $price = "";
			
			if(isset($_POST["upload"])){
				$place = $_POST["place"];
				$location = $_POST["location"];
                    $type = $_POST["type"];
                    $price = $_POST["price"];


				$query = "INSERT into parking_spot VALUES('$place','$location', '$type','$price')";
				$query_run = mysqli_query($con, $query);

				if ($query_run){
					echo "<script> alert('Listing is added')</script>";
				} else{
					echo "<script> alert('Listing was not added')</script>";
				}
			}

		     ?>
               <div class="container-fluid">
                    <div class="row">
                         <div class="col-2"></div>
                         <div class="col-8">
                              <form method = "post" enctype="multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                   <h2>Place</h2>
                                   <input class="place" type="text" name="place">
                                   <h2>Location</h2>
                                   <input class="location" type="text" name="location">
                                   <h2>Type</h2>
                                   <input class="type" type="text" name="type">
                                   </div>
                                   <h2>Price</h2>
                                   <input class="price" type="number" name="price" placeholder="$">
                                   <br>
                                   <br>
                                   <input type="submit" value="Submit" name="upload">

                              </form>
                         </div>
                         <div class="col-2"></div>
                    </div>
               </div>
          </div>
     </section>

     <section class="section-background">
          <div class="container">

               <div class="row">
                    <div class="col-lg-3 col-xs-12">
                         <div class="form">
                              <form action="#">
                                   <h4>Location</h4>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             North (10)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             South (3)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             East (9)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             West (3)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             Central (2)
                                        </label>
                                   </div>

                                   <br>

                                   <h4>Type</h4>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             Shopping Mall (5)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             Public Housing (20)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                             Street (2)
                                        </label>
                                   </div>

                                   <br>


                                   <h4>Price</h4>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                              < $1.20/h (22)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                              < $2/h (2)
                                        </label>
                                   </div>

                                   <div>
                                        <label>
                                             <input type="checkbox">

                                              < $3/h (3)
                                        </label>
                                   </div>
                              </form>
                         </div>
                    </div>

                    <?php
					    // fill in the blanks - select SQL
						$query = "SELECT place FROM parking_spot";
						$result = mysqli_query($con, $query);
						
						while($row = mysqli_fetch_array($result)){
							$place = $row['place'];
							echo "<h4><a href='parking-listing.php?name=$place'> $place<br></a></h4>";
						}

						if(!$result){
							printf("Error: %s \n", mysqli_error($con));
							exit();
						}

					     ?>
                    <div class = "col-6">
					<?php
					    // when place is click, show the description
						if(isset($_GET['place'])){
							$place = $_GET['place'];
							$query = "SELECT location FROM parking_spot WHERE place = '$place' ";
							$query_run = mysqli_query($con,$query);
							$row = mysqli_fetch_array($query_run);
							$desc = $row['location'];	

						echo "<h2>$place</h2>
						<p>$desc<br></p>";

						}else{
							// Else, “Choose a player, or add a player!” will be rendered instead
							echo "";
						}
					?>
				</div>
                              
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <!-- FOOTER -->
     <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Headquarter</h2>
                              </div>
                              <address>
                                   <p>212 Barrington Court <br>New York, ABC 10001</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2020 Company Name</p>
                                   <p>Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact Info</h2>
                              </div>
                              <address>
                                   <p>+1 333 4040 5566</p>
                                   <p><a href="mailto:contact@company.com">contact@company.com</a></p>
                              </address>

                              <div class="footer_menu">
                                   <h2>Quick Links</h2>
                                   <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="terms.html">Terms & Conditions</a></li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Newsletter Signup</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" required>
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Send me">
                                        </form>
                                        <span><sup>*</sup> Please note - we do not spam your email.</span>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </footer>

     <div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title" id="gridSystemModalLabel">Book Now</h4>
                    </div>
                    
                    <div class="modal-body">
                         <form action="#" id="contact-form">
                              <div class="row">
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Pick-up location" required>
                                   </div>

                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Return location" required>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Pick-up date/time" required>
                                   </div>

                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Return date/time" required>
                                   </div>
                              </div>
                              <input type="text" class="form-control" placeholder="Enter full name" required>

                              <div class="row">
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter email address" required>
                                   </div>

                                   <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Enter phone" required>
                                   </div>
                              </div>
                         </form>
                    </div>

                    <div class="modal-footer">
                         <button type="button" class="section-btn btn btn-primary">Book Now</button>
                    </div>
               </div>
          </div>
     </div>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>