<nav class="navbar navbar-default navbar-static-top">
    	<div class="container">
    		<div class="navbar-header">
    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
    			<a class="navbar-brand" href="/"><img class="navbar-brand-image" src="/img/heart-navbar.png" alt="Logo">&nbsp;Heart2Heart</a>
    		</div>
    		<div id="navbar" class="navbar-collapse collapse">
	            <ul class="nav navbar-nav">
	            	<li><a href="/doctor">Doctors</a></li>
					<li><a href="/patients/profile.php">Patients</a></li>
					<li><a href="/public.php">Public</a></li>
					<li><a href="/introduction.php">About Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if($user->isLoggedIn())
						{
							// Dropdown menu
							echo '<li class="dropdown">';
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
							echo 'Hello '.$user->username().' <span class="caret"></span>'; // the text of the dropdown menu
							echo '</a>';
							
							// The contents of the dropdown menu
							echo '<ul class="dropdown-menu">';
							echo '<li><a href="/logout.php">Log out</a></li>';
							echo '</ul>';
							echo '</li>';
						}
						else
						{
							echo '<li>';
							echo '<a href="/html/login.html">Log in</a>';
							echo '</li>';
							/*echo 'Log in&#8230; <span class="caret"></span>';
							echo '</a>';
							
							// The contents of the dropdown
							echo '<ul class="dropdown-menu">';
							echo '<li><a href="/doctor">as a doctor</a></li>';
							echo '<li><a href="/patient">as a patient</a></li>';
							echo '</ul>'; */
						}
					?>
				</p>
			</div><!--/.nav-collapse -->
    	</div>
    </nav>