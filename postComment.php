<?php
    // Get required php modules 
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");
    include_once("/var/www/html/Assignment/PHP/db_connect.php");

    var_dump($_POST);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stmt = $conn->prepare("INSERT INTO reviews (ReviewText, AttractionID, UserID, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $rText, $rAtt, $rUser, $rating);

        $rText = $_POST["comment"];
        $rAtt = $_POST["attID"];
        $rUser = $_POST["userID"];
        $rating = $_POST["rating"];

        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("location: /Assignment/PHP/ReadMore.php?attID=$rAtt");
    } else {
        header("refresh:5;url=https://www.cps630.tech/Assignment/PHP/Assignment.php");
        echo "You should not be here....";
    }
?>