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
    $sql = "SELECT JokeId, Joke_Question, Joke_Answer, users_id FROM Jokes_table";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<h3>" . $row["Joke_Question"]. "</h3>";
				echo  "<div><p>" . $row["Joke_Answer"]. " Submitted by user # " . $row["users_id"] ."</p></div>";
				
			}
		} else {
			echo "0 results";
	}
?>

<a href="index.php">Return to Main Page</a>