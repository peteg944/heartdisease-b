<?php

include('db.php');

// names for POST variables
const POST_USERNAME = 'username';
const POST_PASSWORD = 'password';
const PROP_USER_ID = 'who_logged_in';
const PROP_USER_TYPE = 'user_type';

class User
{
	// Default constructor
	public function __construct()
	{
		// Start session
		session_start();
    }
    
	// Get username
	public function username()
	{
		if($this->isLoggedIn())
		{
			if($_SESSION[PROP_USER_TYPE] == 0) // Doctor
			{
				$conn = connectToDB();
				if($conn == FALSE) return FALSE;
				$query = $conn->prepare('SELECT `firstname` FROM doctor_data WHERE `user_id`=:id LIMIT 1');
				$query->bindValue(':id', $_SESSION[PROP_USER_ID]);
				$query->execute();
				$row = $query->fetch();
				if($row == FALSE) return FALSE;
				
				return $row['firstname'];
			}
		}
		else
			return FALSE;
	}
	
	// Attempt to log in -- returns TRUE if it was successful or FALSE if not
	public function login($username, $password)
	{
		// Check if already logged in
		if($this->isLoggedIn())
			return TRUE;
		
		// Look up this username in the database
		$conn = connectToDB();
		if($conn == FALSE)
			return FALSE;
		
		$userQuery = $conn->prepare('SELECT `id`,`password`,`type` FROM users WHERE `username`=:username LIMIT 1');
		$userQuery->bindValue(':username', $username);
		$userQuery->execute();
		$thisUser = $userQuery->fetch(); // Get a row
		
		// Check if no result
		if($thisUser == FALSE)
			return FALSE;
		
		// Check the hashes
		if(password_verify($password, $thisUser['password']))
		{
			// Set session variable to remember that we are logged in
			$_SESSION[PROP_USER_ID] = $thisUser['id'];
			$_SESSION[PROP_USER_TYPE] = $thisUser['type'];
			return TRUE;
		}
		else
			return FALSE;
	}
	
	// Log out, get rid of the session
	public function logout()
	{
		unset($_SESSION[PROP_USER_ID]);
		return session_destroy();
	}
	
	// Function to check if logged in or not
	public function isLoggedIn()
	{
		return isset($_SESSION[PROP_USER_ID]);
	}
}

?>