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
  				<a href="/doctor"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Patient Management</a>
			</li>
			<li role="presentation">
				<a href="/doctor/profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Your Profile</a>
			</li>
  		</ul>
  		<div id="tab-patients">
	  		<div class="row">
	  			<div class="col-xs-12 col-s-3 col-md-3">
					<div class="list-group">
						<!-- use php here -->
						<?php
							$patients = array(
										array("name"=>"George Papadopoulos","lastseen"=>"Yesterday","dob"=>"Sep 15, 1970","gender"=>"Male"),
										array("name"=>"Jane Doe","lastseen"=>"Mar 13","dob"=>"Oct 24, 1984","gender"=>"Female"),
										array("name"=>"Jane Schmoe","lastseen"=>"Jan 2","dob"=>"Sep 15, 1985","gender"=>"Female"),
										array("name"=>"Joe Schmoe","lastseen"=>"Jan 2","dob"=>"Jan 15, 1947","gender"=>"Male"),
										array("name"=>"Joe Doe","lastseen"=>"Dec 14","dob"=>"Feb 15, 1957","gender"=>"Male"),
										array("name"=>"Lo Doe","lastseen"=>"Dec 13","dob"=>"Mar 15, 1967","gender"=>"Male")/*,
										array("name"=>"Joe Roe", "lastseen"=>"Nov 27", "dob"=>"Apr 15, 1894"),
										array("name"=>"Do Joe", "lastseen"=>"Nov 26", "dob"=>"May 15, 1992"),
										array("name"=>"Joe Joe", "lastseen"=>"Nov 25", "dob"=>"Jun 15, 2000"),
										array("name"=>"Jane Joe", "lastseen"=>"Nov 24", "dob"=>"Jul 15, 1952")*/
										);
							
							$patient_param = $_GET['p'];
							$active_patient = -1;
							if(isset($patient_param))
							{
								if(is_numeric($patient_param))
									$active_patient = $_GET['p'];
								else if($patient_param == "add")
									$active_patient = -2;
							}
							
							$count = 0;
							foreach($patients as $patient)
							{
								echo "<a class=\"list-group-item";
								if($count == $active_patient)
									echo " active";
								echo "\" ";
								echo "href=\"?p=$count\"";
								echo ">\n";
								
								echo "	<h4>".$patient['name']."</h4>\n";
								echo "	<p>Last seen: ".$patient['lastseen']."</p>\n";
								echo "</a>\n";
								
								$count++;
							}
						?>
					</div> <!-- patient selector -->
					<div class="text-center">
						<a href="?p=add">
							<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add a Patient&#8230;</button>
						</a>
					</div>
				</div>
				<!-- patient info -->
				<div class="col-xs-12 col-s-9 col-md-9">
					<div class="patient">
						<?php
							if($active_patient == -1) // none selected
							{
								echo <<<"HTML"
								<h3 class="action-message"><span class="glyphicon glyphicon-hand-left"></span>&nbsp;Select a patient on the left</h3>
HTML;
							}
							else if($active_patient == -2) // add new patient
							{
								echo <<<"HTML"
								<h3>Add a New Patient</h3>
								<form class="form-horizontal">
									<div class="form-group">
										<label for="firstName" class="control-label col-sm-2">First name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="firstName" placeholder="e.g. Jane">
										</div>
									</div>
									<div class="form-group">
										<label for="lastName" class="control-label col-sm-2">Last name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="lastName" placeholder="e.g. Doe">
										</div>
									</div>
								</form>
HTML;
							}
							else if($active_patient >= 0)
							{
								$patient = $patients[$active_patient];
								
								// Patient information
								echo <<<"HTML"
								<h2><img src="/img/person-placeholder.png">{$patient['name']}</h2>
								<div class="row">
									<div class="col-xs-12 col-s-6 col-md-6">
										<table class="table">
											<tr><td>Date of birth:</td><td>{$patient['dob']}</td></tr>
											<tr><td>Gender:</td><td>{$patient['gender']}</td></tr>
											<tr><td>Phone number:</td><td>978-800-6170</td></tr>
											<tr><td>Home address:</td><td>600 Beacon Street, Boston, MA 02215</td></tr>
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
							
							else if($active_patient == "add")
							{
								echo "<h2>add patient</h2>\n";
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