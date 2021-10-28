<?php
	session_start();
	require "dbconfig/config.php"
?>

<?php
$place = $location = $type = $price = $oldplace = "";
    // If a player’s name is clicked, we run SQL queries and create variables to store the queries’ results
    // isset — Determine if a variable is declared, empty or is different than NULL 
	if(isset($_GET["name"])){
	$name = $_GET["name"];
	$query = "SELECT * FROM parking_spot WHERE place = '$name' ";
	// Perform query against a database
	// https://www.php.net/manual/en/mysqli.query.php
	// https://www.w3schools.com/php/func_mysqli_query.asp => mysqli_query(connection, query, resultmode)
	$query_run = mysqli_query($con, $query);
	// Fetch a result row as an associative, a numeric array, or both
	// https://www.php.net/manual/en/mysqli-result.fetch-array.php
	// https://www.w3schools.com/php/func_mysqli_fetch_array.asp
	$row = mysqli_fetch_array($query_run);

	$place = $row["place"];
	$location = $row["location"];
    $type = $row["type"];
    $price = $row["price"];

	}else{
      //Else, “Choose a player to edit!” to be rendered 
	  //echo "<h2>Choose a player to edit!</h2>";
	}
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

<?php
			
			if(isset($_POST["edit"])){
				$oldplace = $_GET["name"];
				$place = $_POST["place"];
				$location = $_POST["location"];
                $type = $_POST["type"];
                $price = $_POST["price"];


				// addslashes - Quote string with slashes
				// https://www.php.net/manual/en/function.addslashes.php
				// https://www.w3schools.com/php/func_string_addslashes.asp
				// file_get_contents - Reads entire file into a string
				// https://www.php.net/manual/en/function.file-get-contents.php
				// https://www.w3schools.com/php/func_filesystem_file_get_contents.asp
	

				$query = "UPDATE parking_spot SET place = '$place', location = '$location', price = '$price', type = '$type' WHERE place = '$oldplace'";
				$query_run = mysqli_query($con, $query);

				if($query_run){
					echo "<script> alert('Parking place updated');
					location.href = 'edit.php';
					</script>";
				}
				else {
					echo "<script> alert('Parking place was NOT updated!')</script>";
				}
			}
		?>

<?php
					   // fill in the blanks - delete SQL
					   $name = "";
					   if(isset($_POST["delete"])){
						   $name = $_GET["name"];

						   $query = "DELETE FROM parking_spot WHERE place = '$name' ";
						   $query_run = mysqli_query($con, $query);

						   if ($query_run){
							   echo "<script> alert('Parking place deleted!');
							   location.href = 'edit.php';
							   </script> ";
						   } else{
							echo "<script> alert('Parking place was not deleted!') </script>";
						   	}
					   }	
					?>

		<div class = "container">
			<div class = "row">
				<div class = "col-3" id="pname">
					<h1>Parking Spots</h1>
                    <h2>Choose a place to edit!</h2>
					<br>
					<?php
						$query = "SELECT place FROM parking_spot";
						$result = mysqli_query($con, $query);
						while($row = mysqli_fetch_array($result)){
							$place = $row['place'];
							echo "<h4><a href='edit.php?name=$place'>  $place <br> </a></h4>";
						}
					?>
				</div>
				<div class = "col-9">
					<?php
					if(isset($_GET["name"])){
						$name = $_GET["name"];
						echo '<form method = "post" enctype="multipart/form-data" action = "';
						// htmlspecialchars() function converts special characters to HTML entities, replace HTML characters like < and > with &lt; and &gt; to prevent XSS.  
						echo htmlspecialchars("edit.php?name=$name");
						echo '">';
						echo '
						<h2>Place</h2>
						<input class="place" name="place" value="'.$place.'"">
						<h2>Location</h2>
						<input class="location" type="text" name="location" value = "'.$location.'">
                        <h2>Type</h2>
						<input class="type" type="text" name="type" value = "'.$type.'">
                        <h2>Price</h2>
                        <input class="price" type="number" name="price" value = "'.$price.'">
                        <br>
                        <br>
						<input type="submit" value="Submit" name="edit">
                        <input type="submit" name="delete" value="Delete Parking">
						</form>';
                    
					}
					else{
						echo '';
					}
					?>
					
				</div>
			</div>
		</div>

     

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