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
  	<div class="jumbotron" id="jumbotron-homepage">
  		<header class="container" id="header-homepage">
  			<img class="logo" src="/img/heart.png">
  			<h2>Real-time cardiac analysis for doctors.</h2>
  			<h2>Fast, relevant information for patients.</h2>
	  	</header>
	  	<div class="container" id="container-jumpoff">
	  		<div class="row">
				<div class="col-md-4">
					<a href="/doctor.php" class="jumpoff-link">
						<p><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>&nbsp;Doctors &raquo;</p>
					</a>
				</div>
				<div class="col-md-4">
					<a href="/patient.php" class="jumpoff-link">
						<p><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Patients &raquo;</p>
					</a>
				</div>
				<div class="col-md-4">
					<a href="/public.php" class="jumpoff-link">
						<p><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Public &raquo;</p>
					</a>
				</div>
	      </div>
	  	</div>
	</div>
    <?php include("include/body_bottom.php"); ?>
  </body>
</html>