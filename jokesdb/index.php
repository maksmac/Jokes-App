<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h1>Welcome to my jokes app</h1>
		<a href="loginForm.php">login</a>
        <a href="logout.php">logout</a>
        <a href="registerNewUser.php">register new user</a>
		<?php
		include "db_connect.php";
		//include "searchAllJokes.php";
		?>
		<form class="form-horizontal" action="searchKeyword.php">
		<fieldset>

		<!-- Form Name -->
		<legend>Search For a Joke</legend>

		<!-- Search input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="keyword">Search Input</label>
		<div class="col-md-5">
			<input id="keyword" name="keyword" type="search" placeholder="eg. chicken" class="form-control input-md" required="">
			<p class="help-block">Search joke with keyword</p>
		</div>
		</div>

		<!-- Button -->
		<div class="form-group">
		<label class="col-md-4 control-label" for="submit"></label>
		<div class="col-md-4">
			<button id="submit" name="submit" class="btn btn-primary">Search</button>
		</div>
		</div>

		</fieldset>
		</form>

		<hr>

		<?php
			session_start();
			if (isset($_SESSION['userId'])):
		?>

		<form class="form-horizontal" action="addJoke.php">
		<fieldset>

		<!-- Form Name -->
		<legend>Add a Joke</legend>

		<!-- Text input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="question"></label>  
		<div class="col-md-5">
		<input id="question" name="question" type="text" placeholder="eg. why did the chicken cross the road?" class="form-control input-md" required="">
			
		</div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="answer"></label>  
		<div class="col-md-5">
		<input id="answer" name="answer" type="text" placeholder="eg. to get to the other side!" class="form-control input-md" required="">
			
		</div>
		<!-- Button -->
		<div class="form-group">
		<label class="col-md-4 control-label" for="Submit"></label>
		<div class="col-md-4">
			<button id="Submit" name="Submit" class="btn btn-primary">Submit</button>
		</div>
		</div>

		</div>

		</fieldset>
		</form>
		<?php else: ?>
		<div align="center">
		<h3>Login</h3>
		<div> You will need a Google account to add a new joke.</div>
		<a href="googleLogin.php">Login Here</a>
		</div>
		<?php endif; ?>	
		<?php
		//include "searchKeyword.php";		
		
		$mysqli->close();
		?>

	</body>
</html>