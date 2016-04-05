<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('../include/head.php'); ?>
	<title>View Patients - Heart2Heart</title>
  </head>
  <body>
    <?php include("../include/nav.php"); ?>
  	<div class="container">
  		<ul class="nav nav-tabs">
  			<li role="presentation">
				<a href="/patients/profile.php">
					<span class="glyphicon glyphicon-user"></span>&nbsp;Your Profile
				</a>
			</li>
  			<li class="active" role="presentation">
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
	  		<div class="row">
	  			<div class="col-xs-121 col-s-3 col-md-3">
					<div class="list-group">
						<?php
							include('../include/db.php');
							
							// Global data
							$months = array("January","February","March","April","May","June","July",
											"August","September","October","November","December");
							
							// Load patients from DB
							$conn = connectToDB();
							if($conn == FALSE)
								die('Could not connect to the database. Uh oh.\n');
							
							$patients = $conn->query('SELECT * FROM patients ORDER BY lastname');
							
							$patientParam = $_GET['p'];
							$activePatient = -1;
							if(isset($patientParam))
							{
								if(is_numeric($patientParam))
									$activePatient = $_GET['p'];
								else if($patientParam == "add")
									$activePatient = -2;
							}
							
							// Output the patients list
							foreach($patients as $patient)
							{
								echo '<a class="list-group-item';
								if($patient['patient_id'] == $activePatient)
									echo ' active';
								echo '" ';
								echo 'href="?p='.$patient['patient_id'];
								echo '">';
								
								echo '	<h4>'.$patient['lastname'].', '.$patient['firstname'].'</h4>';
								echo '</a>';
							}
						?>
					</div> <!-- patient selector -->
					<div class="text-center">
					</div>
				</div>
				<!-- patient info -->
				<div class="col-xs-122 col-s-9 col-md-9">
					<div class="patient">
						<?php
							if($activePatient == -1) // none selected
							{
								echo <<<"HTML"
								<h3 class="action-message"><span class="glyphicon glyphicon-hand-left"></span>&nbsp;Select a doctor on the left</h3>
HTML;
							}
							else if($activePatient == -2) // add new patient
							{
								echo <<<"HTML"
								<h3>Add a New Patient</h3>
								<form class="form-horizontal" method="post" action="add.php">
									<div class="form-group">
										<label for="firstName" class="control-label col-sm-2">First name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="firstname" name="firstname" placeholder="e.g. Jane">
										</div>
									</div>
									<div class="form-group">
										<label for="lastName" class="control-label col-sm-2">Last name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="lastname" name="lastname" placeholder="e.g. Doe">
										</div>
									</div>
									<div class="form-group">
										<label for="dateOfBirth" class="control-label col-sm-2">Date of birth</label>
										<div class="col-sm-2">
											<select class="form-control" id="dob_month" name="dob_month">
HTML;
											// Generate months for select control
											for($i = 0; $i < count($months); $i++)
												echo '<option value="'.$i.'">'.$months[$i].'</option>\n';
											
											echo <<<"HTML"
											</select>
										</div>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="dob_day" name="dob_day" placeholder="Day">
										</div>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="dob_year" name="dob_year" placeholder="Year">
										</div>
									</div>
									<div class="form-group">
										<label for="address" class="control-label col-sm-2">Address</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="address" name="address" placeholder="100 Bay State Road, Boston, MA 02215">
										</div>
									</div>
									<div class="form-group">
										<label for="phone" class="control-label col-sm-2">Phone number</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="phone" name="phone" placeholder="978-617-7810">
										</div>
									</div>
									<div class="form-group">
										<label for="gender" class="control-label col-sm-2">Gender</label>
										<div class="col-sm-2">
											<select class="form-control" id="gender" name="gender">
												<option>Female</option>
												<option>Male</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-offset-2">
											<input type="hidden" name="doctor_id" value="0">
											<button type="submit" class="btn btn-primary">Submit Patient</button>
											<a href="/doctor"><button type="button" class="btn btn-link">Cancel</button></a>
										</div>
									</div>
								</form>
HTML;
							}
							else if($activePatient >= 0) // Get info for this patient
							{
								$patientQuery = $conn->prepare('SELECT * FROM patients WHERE `patient_id`=:patient_id LIMIT 1');
								$patientQuery->bindValue(':patient_id', $activePatient);
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