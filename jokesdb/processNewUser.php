<?php
    include "db_connect.php";

    $newUsername = $_GET['username'];
    $newPassword1 = $_GET['password1'];
    $newPassword2 = $_GET['password2'];

    $hashedPassword = password_hash($newPassword1, PASSWORD_DEFAULT);

    if ($newPassword1 != $newPassword2){
        echo "Passwords do not match";
        exit;
    }

    preg_match('/[0-9]+/', $newPassword1, $matches);
    if (sizeof($matches) == 0){
        echo "The password must have at least one number";
        exit;
    }

    preg_match('/[!@#$%^&*()]+/', $newPassword1, $matches);

    if (sizeof($matches) == 0){
        echo "The password must have at least one special character";
        exit;
    }

    if (strlen($newPassword1) <= 8){
        echo "The password must have at least 8 characters";
        exit;
    }

    //check for duplicate username

    $sql = "SELECT * FROM users WHERE username = '$newUsername'";

    $result = $mysqli->query($sql) or die(mysqli_error($mysqli));

    if ($result->num_rows > 0){
        echo "The username " . $newUsername . " already exists";
        exit;
    }


    //inserting new user
    $stmt = $mysqli->prepare("INSERT INTO users (id, username, password) VALUES (null, ?, ?)");
    //$sql = "INSERT INTO users (id, username, password) VALUES (null, '$newUsername', '$hashedPassword')"
    $stmt->bind_param('ss', $newUsername, $hashedPassword);
    $result = $stmt->execute();


    if ($result){
        echo "Registration successful";
    }
    else {
        echo "Error occurred";
    }
?>
<a href="index.php">Return to main page</a>