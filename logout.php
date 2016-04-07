<?php

include('include/users.php');

$user = new User();
if($user->logout())
{
	header('Location: /');
	die('Logged out successfully');
}
else
{
	header('Location: /');
	die('Prblem logging out');
}

?>