<?php
    require_once(__DIR__ . "/../model/config.php");
    
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
    $query = $_SESSION["connection"]->query("SELECT salt, password FROM users WHERE username = '$username'");
    
    
    if($query->num_rows == 1) {
        $row = $query->fetch_array();
        
        //if the row equals the crypt then the session authenticated eequals true//
        if($row["password"] === crypt($password, $row["salt"])) {
            $_SESSION["authenticated"] = true;
            echo "<p>Login Successful!</p>";
        }
        //this echo comes up when the username and password is invalid//
        else {
            echo "<p>Invalid username and password1</p>";
        }
    }
    else {
        //this is like the same one from up top//
        echo "<p> Invalid username and password2</p>";
    }
