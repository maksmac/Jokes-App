<?php
	session_start();

	if (! $_SESSION['username']) {
		echo 'only logged in users can view this page <a href="loginForm.php">Go To Login</a>';
		exit;
	}

	$userId = $_SESSION['userId'];

	include "db_connect.php";
    $jokeFromForm = addslashes($_GET["question"]);
	$answerFromForm = addslashes($_GET["answer"]);
		
	echo "<h2>Trying to add new joke ".$jokeFromForm." : " . $answerFromForm."</h2>";
	$stmt = $mysqli->prepare("INSERT INTO Jokes_table(JokeId, Joke_Question, Joke_Answer, users_id) VALUES (NULL, ?, ?, ?)");
	$stmt->bind_param("ssi", $jokeFromForm, $answerFromForm, $userId);

	$stmt->execute();
	echo $userId;
	echo $mysqli->error;
	$stmt->close();

	include "searchAllJokes.php";
?>

<a href="index.php">Return to Main Page</a>