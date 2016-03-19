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
    <?php include("include/nav.php"); ?>
  	<div class="container">
  		<div id="tabs-interface"> <!-- tabs-interface -->
	  		<ul class="nav nav-tabs" role="tablist">
	  			<li class="active">
	  				<a href="#tab-patients" role="tab" data-toggle="tab">
	  					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Patient Management
  					</a>
				</li>
				<li>
					<a href="#tab-profile" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Your Profile
					</a>
				</li>
				<li>
					<a href="#tab-prefs" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;Preferences
					</a>
				</li>
	  		</ul>
	  		<div class="tab-content">
		  		<div class="tab-pane fade in active" id="tab-patients" role="tabpanel">
		  			<div class="row">
						<div class="list-group col-xs-4 col-md-3">
							<!-- use php here -->
							<?php
								$patients = array(
											array("name"=>"George Papadopoulos", "lastseen"=>"Yesterday", "dob"=>"Sep 15, 1970"),
											array("name"=>"Jane Doe", "lastseen"=>"Mar 13", "dob"=>"Oct 24, 1984"),
											array("name"=>"Jane Schmoe", "lastseen"=>"Jan 2", "dob"=>"Sep 15, 1985"),
											array("name"=>"Joe Schmoe", "lastseen"=>"Jan 2", "dob"=>"Jan 15, 1947"),
											array("name"=>"Joe Doe", "lastseen"=>"Dec 14", "dob"=>"Feb 15, 1957"),
											array("name"=>"Lo Doe", "lastseen"=>"Dec 13", "dob"=>"Mar 15, 1967"),
											array("name"=>"Joe Roe", "lastseen"=>"Nov 27", "dob"=>"Apr 15, 1894"),
											array("name"=>"Do Joe", "lastseen"=>"Nov 26", "dob"=>"May 15, 1992"),
											array("name"=>"Joe Joe", "lastseen"=>"Nov 25", "dob"=>"Jun 15, 2000"),
											array("name"=>"Jane Joe", "lastseen"=>"Nov 24", "dob"=>"Jul 15, 1952")
											);
								
								$active_patient = -1;
								if(isset($_GET['p']))
									$active_patient = $_GET['p'];
								
								$count = 0;
								foreach($patients as $patient)
								{
									echo "<a class=\"list-group-item";
									if($count == $active_patient)
										echo " active";
									echo "\" ";
									echo "href=\"/doctor.php?p=$count\"";
									echo ">\n";
										
									echo "	<h4>".$patient['name']."</h4>\n";
									echo "	<p>Last seen: ".$patient['lastseen']."</p>\n";
									echo "</a>\n";
									
									$count++;
								}
							?>
						</div> <!-- patient selector -->
						<div class="col-xs-12 col-md-9">
							<div class="patient">
								<?php
									if($active_patient == -1)
										echo "<h2>Select a patient</h2>";
									else if($active_patient >= 0)
									{
										$patient = $patients[$active_patient];
										echo "<h2><img src=\"/img/gray.png\">".$patient['name']."</h2>";
									}
								?>
							</div>
						</div> <!-- patient info -->
					</div> <!-- end row -->
				</div>
				<div class="tab-pane fade" id="tab-profile" role="tabpanel">
					<h2>Jane Doe<img src="/img/gray.png" alt="Portrait"></h2>
				</div>
				<div class="tab-pane fade" id="tab-prefs" role="tabpanel">
					prefs
				</div>
			</div>
		</div> <!-- tabs-interface -->
  	</div>
    <?php include("include/body_bottom.php"); ?>
    <script>
    	// Tabs
    	$('#tabs-interface a').click(function(e) {
    		e.preventDefault();
    		$(this).tab('show');
    	});
    	
    	// Patients list click
    	$(document).on('click', '#tab-patients .list-group-item', function(e) {
    		location.href = $(this).attr('href');
    	});
    </script>
  </body>
</html>