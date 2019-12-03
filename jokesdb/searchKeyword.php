<head>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
		$( "#accordion" ).accordion();
	} );
	</script>
</head>

<?php
		include "db_connect.php";
		$keywordFromForm = $_GET["keyword"];
		echo "<h2>Show all jokes with the word " . $keywordFromForm . "</h2>";
		$keywordFromForm = "%" . $keywordFromForm. "%";
		//search the db for antelope
		$stmt = $mysqli->prepare("SELECT JokeId, Joke_Question, Joke_Answer, users_id, username FROM Jokes_table JOIN users ON users.id = Jokes_table.users_id WHERE Joke_Question LIKE ?");
		$stmt->bind_param("s", $keywordFromForm);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($jokeId, $jokeQuestion, $jokeAnswer, $userid, $username);
		//$sql = "SELECT JokeId, Joke_Question, Joke_Answer, users_id, username FROM Jokes_table JOIN users ON users.id = Jokes_table.users_id WHERE Joke_Question LIKE '%$keywordFromForm%'";
?>
<div id="accordion">
<?php
	while($row = $stmt->fetch()) {
		$safeJokeQuestion = htmlspecialchars($jokeQuestion);
		$safeJokeAnswer = htmlspecialchars($jokeAnswer);
		echo "<h3>$safeJokeQuestion</h3>";
		echo "<div><p>". $safeJokeAnswer . " --Submitted by user: " . $username ."</p></div>";
		//echo "JokeId: " . $row["JokeId"]. " - Joke_Question: " . $row["Joke_Question"]. " : " . $row["Joke_Answer"]. "<br>";
	}
?>
</div>
<a href="index.php">Return to Main Page</a>