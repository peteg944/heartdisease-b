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
    <?php include('../include/head.php'); ?>
	<title>Contact Us - Heart2Heart</title>
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
		    <div class="contact_desc">
		        <div class="container">
			         <div class="contact-form">
				  	   <h2>Contact Us</h2>
					     <form method="post" action="contact-post.html" class="left_form">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input name="userName" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input name="userEmail" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>Fax</label></span>
						    	<span><input name="userPhone" type="text" class="textbox"></span>
						    </div>
					    </form>
					    <form class="right_form">
					        <div>					    	
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea name="userMsg"> </textarea></span>
						    </div>
						   <div>
						   		<a class="contactbutton">
									<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Submit</button>
								</a>						  
							</div>
					    </form>
					    <div class="clearfix"></div>
				  </div>
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