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
					<li><a href="/patient.php">Patients</a></li>
					<li><a href="/public.php">Public</a></li>
					<li><a href="/introduction.php">About Us</a></li>
				</ul>
				<p class="navbar-text navbar-right">
					<?php
						if($user->isLoggedIn())
							echo '<strong><a href="/logout.php">Logged in</a></strong>';
						else
							echo '<strong>Not logged in</strong>';
					?>
				</p>
			</div><!--/.nav-collapse -->
    	</div>
    </nav>