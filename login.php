<?php

include('include/users.php');

$user = new User();
if($user->login($_POST[POST_USERNAME], $_POST[POST_PASSWORD]))
{
	header('Location: /');
	die('Logged in');
}
else
{
	header('Location: /html/login.html');
	die('Need to log in!!');
}

?>