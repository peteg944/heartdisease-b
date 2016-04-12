<?php
include('../include/top.php');
if(!$user->isLoggedIn())
{
	header('Location: /html/login-patient.html');
	die('You need to login first.');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Heart2Heart</title>

    <!-- CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include("../include/nav.php"); ?>
  	<div class="container">
  		<ul class="nav nav-tabs">
  					<li class="active" role="presentation">
				<a href="/patients/profile.php">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Your Profile
				</a>
			</li>
  			<li role="presentation">
  				<a href="/patients/doctor.php">
  					<span class="glyphicon glyphicon-th-list"></span>&nbsp;Contact A Doctor
					</a>
			</li>
			<li role="presentation">
  				<a href="/patients/introduction.php">
  					<span class="glyphicon glyphicon-th-list"></span>&nbsp;Introduction About Heart Disease
					</a>
			</li>
			<li role="presentation">
  				<a href="/patients/contact.php">
  					<span class="glyphicon glyphicon-th-list"></span>&nbsp;Contact Us
					</a>
			</li>
			
  		</ul>
  	</div>
  	  		<div id="tab-patients">
	  		<div class="row1">
					<div class="list-group">
						<?php

							// Global data
							$months = array("January","February","March","April","May","June","July",
											"August","September","October","November","December");
							
							// Load patients from DB
							$conn = connectToDB();
							if($conn == FALSE)
								die('Could not connect to the database. Uh oh.\n');
							
							$patients = $conn->query('SELECT * FROM patient_data ORDER BY lastname');
							
							$patientParam = $_GET['p'];
							$activePatient = 2;
						?>
					</div> <!-- patient selector -->
					<div class="text-center">
				</div>
				<!-- patient info -->
				<div class="col-xs-12 col-s-9 col-md-9">
					<div class="patient">
						<?php
							if($activePatient == -1) // none selected
							{
								echo <<<"HTML"
								<h3 class="action-message"><span class="glyphicon glyphicon-hand-left"></span>&nbsp;Select a patient on the left</h3>
HTML;
							}
							else if($activePatient >= 0) // Get info for this patient
							{
								$patientQuery = $conn->prepare('SELECT * FROM patient_data WHERE `id`=:id LIMIT 1');
								$patientQuery->bindValue(':id', $activePatient);
								$patientQuery->execute();
								$patient = $patientQuery->fetch(); // Fetch a row (the only row)
								
								if($patient == FALSE)
									echo "Could not retrieve this patient, sorry.\n";
								
								// Patient information
								$name = $patient['firstname'].' '.$patient['lastname'];
								$dob = $months[$patient['dob_month']].' '.$patient['dob_day'].', '.$patient['dob_year'];
								$gender = $patient['gender'];
								$phone = $patient['phone'];
								$address = $patient['address'];
								echo <<<"HTML"
								<h2><img src="/img/person-placeholder.png">{$name}</h2>
								<div class="row">
									<div class="col-xs-12 col-s-6 col-md-6">
										<table class="table">
											<tr><td>Date of birth:</td><td>{$dob}</td></tr>
											<tr><td>Gender:</td><td>{$gender}</td></tr>
											<tr><td>Phone number:</td><td>{$phone}</td></tr>
											<tr><td>Home address:</td><td>{$address}</td></tr>
										</table>
									</div>
								</div>
HTML;
								
								// Upload / view video results
								echo <<<"HTML"
								<div class="row"><!-- upload file -->
									<div class="col-xs-12 col-s-6 col-md-6">
										<h4>Upload a DICOM file</h4>
										<form action="upload.php" class="dropzone" id="imageUpload">
											<span class="dz-message">Drop DICOM file here!</span>
										</form>
									</div>
								</div>
HTML;
							}
						?>
					</div>
				</div> <!-- patient info -->
			</div> <!-- end row -->
		</div>
  	</div>
     <?php include("../include/body_bottom.php"); ?>
    <script src="/js/dropzone.js"></script>
    <script>
    	// Patients list click
    	$(document).on('click', '#tab-patients .list-group-item', function(e) {
    		location.href = $(this).attr('href');
    	});
    </script>
  </body>
</html>