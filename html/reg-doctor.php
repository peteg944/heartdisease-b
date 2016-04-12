<?php
// Check if the form was submitted
if(isset($_POST['email'], $_POST['pass'], $_POST['cpass'], $_POST['fname'],
	$_POST['lname'], $_POST['phone'], $_POST['hospital'], $_POST['interests'], $_POST['education']))
{
	include('../include/db.php');
	
	// Connect to database
	$conn = connectToDB();
	if($conn == FALSE)
		die('Error connecting to database, uh oh');
	
	// Add a user
	$insertQuery = $conn->prepare("INSERT INTO users (`username`,`password`,`type`) VALUES(:user, :pass, :type)");
	$insertQuery->bindValue(':user', $_POST['email']);
	$insertQuery->bindValue(':pass', password_hash($_POST['pass'], PASSWORD_DEFAULT));
	$insertQuery->bindValue(':type', 0); // type 0 is doctor
	$insertQuery->execute();
	
	// Add the doctor's data
	$insertDocColumns = "INSERT INTO doctor_data(`user_id`,`firstname`,`lastname`,`phone`,`hospital`,`interests`,`education`)";
	$insertDocValues = "VALUES (LAST_INSERT_ID(), :firstname, :lastname, :phone, :hospital, :interests, :education)";
	$insertQueryDoc = $conn->prepare($insertDocColumns.' '.$insertDocValues);
	$insertQueryDoc->bindValue(':firstname', $_POST['fname']);
	$insertQueryDoc->bindValue(':lastname', $_POST['lname']);
	$insertQueryDoc->bindValue(':phone', $_POST['phone']);
	$insertQueryDoc->bindValue(':hospital', $_POST['hospital']);
	$insertQueryDoc->bindValue(':interests', $_POST['interests']);
	$insertQueryDoc->bindValue(':education', $_POST['education']);
	$insertQueryDoc->execute();
	$insertedRowDoc = $insertQueryDoc->fetch();
	
	// Show a confirmation
	echo <<<"HTML"
	<html>
	<head>
		<link rel="stylesheet" media="screen" href="css/css.css" />
		<meta http-equiv="refresh" content="3; url=/">
	</head>
	<body>
		<h1>Account creation successful!</h1>
		<h2>Taking you to the homepage&hellip;</h2>
	</body>
	</html>
HTML;
}
else
{

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>sign up</title>
<link rel="stylesheet" media="screen" href="css/css.css" />
</head>
<div style="display:none"></div>
<form id="msform" action="/html/reg-doctor.php" method="post">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Personal Details</li>
		<li>Job Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">This is step 1</h3>
		<input type="text" name="email" placeholder="Email" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We will never sell it</h3>
		<input type="text" name="fname" placeholder="First Name" />
		<input type="text" name="lname" placeholder="Last Name" />
		<input type="text" name="phone" placeholder="Phone" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">job details</h2>
		<h3 class="fs-subtitle">Your information heart disease</h3>
		<input type="text" name="hospital" placeholder="the hospital you work in" />
		<input type="text" name="interests" placeholder="clinical interests" />
		<input type="text" name="education" placeholder="medical education" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/jQuery.time.js" type="text/javascript"></script>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>

</body>
</html>
<?php
	} // close else
?>