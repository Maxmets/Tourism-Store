<?php
    // Get required php modules 
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");
    require_once("/var/www/html/Assignment/PHP/db_connect.php");

    // Start Session
    session_start();

    $uID = (int)$_SESSION["id"];

    // echo "$uID";

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

        $stmt = $conn->prepare("SELECT NameOfUser, UserName, tel, address, email  FROM users WHERE UserID=?");
        $stmt->bind_param("i", $userID);
        $userID = $uID;
        // echo "asdasdas";

        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            var_dump($result->fetch_assoc());
        } else {
            echo "<p> Oops! Something went wrong, Please try again later. </p>";
            header("refresh:5;url=https://www.cps630.tech/Assignment/PHP/Assignment.php");
        }

    } else {
        header("location: /Assignment/PHP/Login.php");    
    }
?>