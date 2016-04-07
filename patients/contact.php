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
  					<li role="presentation">
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
			<li class="active" role="presentation">
  				<a href="/patients/contact.php">
  					<span class="glyphicon glyphicon-th-list"></span>&nbsp;Contact Us
					</a>
			</li>
			
  		</ul>
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
    <?php include("../include/body_bottom.php"); ?>
  </body>
</html>