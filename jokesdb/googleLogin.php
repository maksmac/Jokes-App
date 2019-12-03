<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();



    require_once('vendor/autoload.php');


    $client_id = '975722038463-u8skkkk9bvbktbm8rve8l1tc1flricpu.apps.googleusercontent.com';
    $client_secret = '6FTKkekwdl56GuyuGd8BzYod';
    $redirect_uri = 'https://jokes-app-itt-305.herokuapp.com/jokesdb/googleLogin.php';


    $db_username = 'e48oxaowx6xev76t';
    $db_password = 'amgpi1p16ldin1t7';
    $host_name = 'hcm4e9frmbwfez47.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    $db_name = 'p02svjwrxx0i9j6d';



    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope("email");
    $client->addScope("profile");
    $service = new Google_Service_Oauth2($client);



    if(isset($_GET['logout'])) {
        $client->revokeToken($_SESSION['access_token']);
        session_destroy();
        header('Location: index.php');
    }


    if (isset($_GET['code'])){
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        header('Location: '. filter_var($redirect_uri, FILTER_SANITIZE_URL));
        exit;
    }




    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
    } else {
        $authURL = $client->createAuthURL();
    }



    echo '<div style="margin:20px">';
    if (isset($authURL)){

        echo "<div align='center'>";
        echo '<h3>Login</h3>';
        echo '<div>You will need a Google account to sign in</div>';
        echo '<a class="login" href="'. $authURL . '">Login here</a>';
        echo "</div>";

    } else {

        $user = $service->userinfo->get();


        $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
        if ($mysqli->connect_error){
            die('Error: (' .$mysqli->connect_errno.') '. $mysqli->connect_error);
        }


        $result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
        $user_count = $result->fetch_object()->usercount;


        echo '<img src="'.$user->picture.'" style="float: right; margin-top: 33px;" />';
        $user_link = "https://plus.google.com/".$user->id;
        $logout_uri = $redirect_uri.'?logout=1';

        if($user_count){
            echo 'Welcome back '.$user->name.'! [<a href="'.$logout_uri.'">Log out</a>]';
        }
        else {
            
            echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$logout_uri.'">Log out</a>]';
            $statment = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?, ?, ?, ?, ?)");
            
            $statment->bind_param('issss', $user->id, $user->name, $user->email, $user_link, $user->picture);
            $statment->execute();
            echo $mysqli->error;
        }
        echo "<p>Data about this user. <ul><li>Username: ".$user->name."</li><li>user id: ".$user->id."</li><li>email: ".$user->email."</li></ul></p>";

        $_SESSION['username'] = $user->name;
        $_SESSION['userId'] = $user->id;
        $_SESSION['useremail'] = $user->email;
    }
    echo '</div>';
?>
