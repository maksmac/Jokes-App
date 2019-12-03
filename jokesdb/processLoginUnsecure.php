<head>
</head>

<?php
        session_start();
		include "db_connect.php";
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userid, $uname, $pw);
        //$sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";

        if ($stmt -> num_rows == 1){
            echo "1 User found<br>";
            $stmt -> fetch();
            if (password_verify($password, $pw)){
                echo "Password Verified<br>";
                echo "Login Sucess<br>";
                $_SESSION['username'] = $uname;
                $_SESSION['userId'] = $userid;
                exit;
            }
            else {
                $_SESSION = [];
                session_destroy();
            }
        }
        else {
            $_SESSION = [];
            session_destroy();
        }

        echo "Login failed <br>";
        echo "<br><a href='index.php'>return to home page<a></br>";

?>
<a href="index.php">Return to Main Page</a>