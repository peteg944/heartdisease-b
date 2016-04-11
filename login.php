<?php

include('include/users.php');

$user = new User();
$username = $_POST[POST_USERNAME];
$password = $_POST[POST_PASSWORD];

if(isset($username) && isset($password))
{
	if($user->login($username, $password))
	{
		header('Location: /');
		die('Logged in');
	}
	else
	{
		header('Location: /html/login.html');
		die('Need to log in!!');
	}
}

?>