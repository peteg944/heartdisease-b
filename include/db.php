<?php
	
function connectToDB()
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=heart2heart;port=3306;charset=utf8mb4', 'heart', 'heart2heart');
		return $conn;
	}
	catch(PDOException $e) {
		return FALSE;
	}
}
	
?>