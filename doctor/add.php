<?php
include('../include/db.php');

// Patient data is submitted here with POST //

// Open up the database
$conn = connectToDB();
if($conn == FALSE)
	die('Could not connect to the database. Uh oh.\n');

// Set up INSERT statement
$insertCols = "INSERT INTO patient_data (`doctor_id`, `firstname`, `lastname`, `dob_month`, `dob_day`, `dob_year`, `phone`, `address`, `gender`)";
$insertVals = "VALUES(:doctor_id, :firstname, :lastname, :dob_month, :dob_day, :dob_year, :phone, :address, :gender)";
$insertQuery = $conn->prepare($insertCols.' '.$insertVals);
$insertQuery->bindValue(':doctor_id', $_POST['doctor_id']);
$insertQuery->bindValue(':firstname', $_POST['firstname']);
$insertQuery->bindValue(':lastname', $_POST['lastname']);
$insertQuery->bindValue(':dob_month', $_POST['dob_month']);
$insertQuery->bindValue(':dob_day', $_POST['dob_day']);
$insertQuery->bindValue(':dob_year', $_POST['dob_year']);
$insertQuery->bindValue(':phone', $_POST['phone']);
$insertQuery->bindValue(':address', $_POST['address']);
$insertQuery->bindValue(':gender', $_POST['gender']);

// Run the INSERT
$insertQuery->execute();
$insertedRow = $insertQuery->fetch();
error_log($insertedRow);

// Go to doctor page
header('Location: /doctor/');
die();

/*
echo $_POST['doctor_id'].'<br>';
echo $_POST['firstname'].'<br>';
echo $_POST['lastname'].'<br>';
echo $_POST['dob_month'].'<br>';
echo $_POST['dob_day'].'<br>';
echo $_POST['dob_year'].'<br>';
echo $_POST['phone'].'<br>';
echo $_POST['address'].'<br>';
echo $_POST['gender'].'<br>';
*/

?>