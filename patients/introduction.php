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
			<li class="active" role="presentation">
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
	<div class="introcontainer">
		<article class="text-center">
			<p class="lead">We all have a heart. It’s our heart that gives us the moments in life to imagine, create and discover.</p>
			<p>However, cardiovascular disease threatens to all of these movements. And most cardiovascular disease affects older adults. The average age of death from cardiovascular disease in the developed world is around 80 while it is around 68 in the developing world. Therefore, to help more people live longer and enjoy their lives, we can use data science to help doctors work more efficiently, diagnose heart conditions early, and give the advice of cardiovascular disease treatment.</p>
			<a class="linkcolor" href="http://www.heart.org/HEARTORG/Caregiver/Resources/WhatisCardiovascularDisease/What-is-Cardiovascular-Disease_UCM_301852_Article.jsp#.Vww1DZMrLPA"><p class="linktootherwebsite">What is heart disease?</p></a>
			<a class="linkcolor" href="http://www.webmd.com/heart-disease/"><p class="linktootherwebsite">WebMD Heart Disease Health Center</p></a>
			<a class="linkcolor" href="http://www.cdc.gov/heartdisease/"><p class="linktootherwebsite">CDC Health Disease Home</p></a>
			<a class="linkcolor" href="http://www.mayoclinic.org/diseases-conditions/heart-disease/basics/definition/CON-20034056?p=1"><p class="linktootherwebsite">Mayo Foundation for Medical Education and Research</p></a>
			<a class="linkcolor" href="http://www.nhlbi.nih.gov/files/docs/public/heart/living_well.pdf"><p class="linktootherwebsite">Your Guide to Living Well with Heart Disease</p></a>
			
			
		</article>
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