<?php

include('db.php');

// names for POST variables
const POST_USERNAME = 'username';
const POST_PASSWORD = 'password';

const PROP_USER_ID = 'who_logged_in';
const PROP_USER_TYPE = 'user_type';
const PROP_DOC_ID = 'doc_id';
const PROP_PATIENT_ID = 'patient_id';

class User
{
	private $username;
	
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
			if(isset($username)) // if we already have it
				return $username;
				
			if($_SESSION[PROP_USER_TYPE] == 0) // Doctor
			{
				$conn = connectToDB();
				if($conn == FALSE) return FALSE;
				$query = $conn->prepare('SELECT `firstname` FROM doctor_data WHERE `user_id`=:userid LIMIT 1');
				$query->bindValue(':userid', $_SESSION[PROP_USER_ID]);
				$query->execute();
				$row = $query->fetch();
				if($row == FALSE) return FALSE;
				
				$username = $row['firstname'];
				return $username;
			}
		}
		else
			return FALSE;
	}
	
	// Get doc id
	public function doctorID()
	{
		if(isset($_SESSION[PROP_DOC_ID]))
			return $_SESSION[PROP_DOC_ID];
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
			
			if($thisUser['type'] == 0) // Doctor
			{
				// Get the doctor ID
				$query = $conn->prepare('SELECT `id` FROM doctor_data WHERE `user_id`=:userid LIMIT 1');
				$query->bindValue(':userid', $thisUser['id']);
				$query->execute();
				$row = $query->fetch();
				if($row != FALSE)
					$_SESSION[PROP_DOC_ID] = $row['id'];
			}

			return TRUE;
		}
		else
			return FALSE;
	}
	
	// Log out, get rid of the session
	public function logout()
	{
		unset($_SESSION[PROP_USER_ID]);
		unset($_SESSION[PROP_USER_TYPE]);
		unset($_SESSION[PROP_DOC_ID]);
		unset($_SESSION[PROP_PATIENT_ID]);
		return session_destroy();
	}
	
	// Function to check if logged in or not
	public function isLoggedIn()
	{
		return isset($_SESSION[PROP_USER_ID]);
	}
}

?>