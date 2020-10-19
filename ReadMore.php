<?php
    // Get required php modules 
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");
    include_once("/var/www/html/Assignment/PHP/db_connect.php");

    // Init Season
    session_start();

?>

<!DOCTYPE html>
    <html>
    <head>
        <?php
            require_once("/var/www/html/Assignment/PHP/head.php");
        ?>
    </head>
    <body>

<?php
    $attID = isset($_GET["attID"]) ? $_GET["attID"] : false;
    if($attID == false){
        $c1 = rand(1,5);
        $a1 = rand(1,4);
        $aID = $c1 . "1" . $a1;
        header("location: /Assignment/PHP/ReadMore.php?attID=$aID");
        exit;
    } else {
        if($APP_ENV == "dev")
            echo "<p>The Attraction is: $attID</p>";
    }

    $stmt = $conn->prepare("SELECT * FROM attractions WHERE AttractionID = ?");
    $stmt->bind_param("i", $attID);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        $nameOfAtt = $row["NameOfAttraction"];
        $img1 = $row["Image"];
        $img2 = $row["Image2"];
        $img3 = $row["Image3"];
        $img4 = $row["Image4"];
        $creationDate = $row["DateOfCreation"];
        $founderName = $row["NameOfFounder"];
        $directions = $row["Direction"];        
        $dimensions = $row["Dimensions"];
        $additionalInfo = $row["additionalInfo"];  
        
        if($APP_ENV == "dev"){
            echo "id: " . $row["AttractionID"]. " - Name: " . $row["NameOfAttraction"]. " - Desc: " . $row["DescriptionOfAttraction"]. "<br>";
        }

        $height = "20%"; $width = "20%";

        echo "<div class=\"title\"> $nameOfAtt </div>";
        require_once("/var/www/html/Assignment/PHP/navbar.php");
        echo "
            <div id=\"container\" class='container'>
            <main>
                <h2>Images</h2>
                <hr>
                
                <section id=\"ImageSection\">
                        <img class='image' id='slide' src=\"$img1\" alt=\"Image 1 of $nameOfAtt\" height=\"$height\" width=\"$width\">
                        <img class='image' id='slide' src=\"$img2\" alt=\"Image 2 of $nameOfAtt\" height=\"$height\" width=\"$width\">
                        <img class='image' id='slide' src=\"$img3\" alt=\"Image 3 of $nameOfAtt\" height=\"$height\" width=\"$width\">
                        <img class='image' id='slide' src=\"$img4\" alt=\"Image 4 of $nameOfAtt\" height=\"$height\" width=\"$width\">
                <br>
                </section>
                ";

                $value = get_rating($conn, $attID);
        
                if($value !== false){
                    $totalRating = $value["totalRating"];
                    $totalRows = $value["totalRows"];
                    $avgRating = round($value["avg"], 2);
                    $avgPercentage = ceil(($avgRating / 5.0) * 100);
                  
                    echo "
                    <section id=\"RatingSection\">
                    <h2>Rating</h2>
                    <hr>
                    <div class=\"stars-outer\">
                        <div class=\"stars-inner\" style=\"width:$avgPercentage%;\"></div>
                    </div><br>
                    <h3>Current Rating: $avgRating</h3> 
                    <h6>Total Rating: $totalRating with $totalRows ratings</h6>
                    </section>
                    ";
                } else {
                    echo "
                    <section id=\"RatingSection\">
                    <h2>Rating</h2>
                    <hr>
                    <h3>No Reviews at the moment.</h3>
                    <h4>Consider adding one <a href=\"#ReviewSection\">here</a></h4>
                    </section>";
                }
        
                echo "
                <section id=\"DescriptionSection\">
                    <h2>Description</h2>
                    <hr>
                    <h3>Date of Creation</h3>
                    $creationDate
                    <h3>Name of Founder</h3>
                    $founderName
                    <h3>Dimensions</h3>
                    $dimensions
                    <h3>Directions to Attraction</h3>
                    $directions
                    <h3>Additional Info</h3>
                    $additionalInfo
                <br>
                </section>
            ";

        // Review Seperator
        echo "
        <section id=\"ReviewSection\">
        <h2>Reviews</h2>
        <hr>
        ";

		// Review Submit a Comment		
        if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
			// Not Logged in
            echo "
            <div id=\"respond\">
			<h3><a id=\"gotoLogin\" href=\"/Assignment/PHP/Login.php\">To leave a comment: Please Login</a></h3>
            </div>
			";
		} else {
			// Logged in
            $uID = $_SESSION["id"];
            
            echo "
            <div id=\"respond\">
            <h3>Leave a Comment</h3>
            <form action=\"/Assignment/PHP/postComment.php\" method=\"post\" id=\"commentform\">
                <input type=\"number\" name=\"userID\" id=\"userID\" value=\"$uID\">
                <input type=\"number\" name=\"attID\" id=\"attID\" value=\"$attID\">
				<label for=\"rating\" class=\"required\">Rating:</label><br>
				<!-- 5 Star Rating System -->
				<div class=\"rating\">
					<input type=\"radio\" id=\"star5\" name=\"rating\" value=\"5\" required />
					<label for=\"star5\" title\"Five Stars\">5 stars</label>
					<input type=\"radio\" id=\"star4\" name=\"rating\" value=\"4\" />
					<label for=\"star4\" title\"Four Stars\">4 stars</label>
					<input type=\"radio\" id=\"star3\" name=\"rating\" value=\"3\" />
					<label for=\"star3\" title\"Three Stars\">3 stars</label>
					<input type=\"radio\" id=\"star2\" name=\"rating\" value=\"2\" />
					<label for=\"star2\" title\"Two Stars\">2 stars</label>
					<input type=\"radio\" id=\"star1\" name=\"rating\" value=\"1\" />
					<label for=\"star1\" title\"One Stars\">1 stars</label>
				</div><br><br><br>
				<label for=\"comment\" class=\"required\">Your Message:</label>
                <textarea name=\"comment\" id=\"comment\" rows=\"10\" tabindex=\"4\" required></textarea>
                <input name=\"submit\" type=\"submit\" />
            </form>
            </div>
            ";
        }


        // Get Reviews for the attraction id
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE AttractionID = ?");
        $stmt->bind_param("i", $attID);

        $stmt->execute();
        $result = $stmt->get_result();

       
        if($result->num_rows != 0){
            while($reviewInfo = $result->fetch_assoc()){
                // Get UserID
                $userID = $reviewInfo["UserID"];
                $reviewText = $reviewInfo["ReviewText"];
                $reviewTime = $reviewInfo["TimeOfReview"];
                $reviewRating = $reviewInfo["rating"];
                $ratingPercentage = ($reviewRating/5) * 100;

                // Get User's Name and Username of account
                $stmt = $conn->prepare("SELECT NameOfUser, UserName FROM users WHERE UserID = ?");
                $stmt->bind_param("i", $userID);
                $stmt->execute();
                $userInfo = $stmt->get_result()->fetch_assoc();
                $userName = $userInfo["NameOfUser"];
                
                echo "
                <h3 class=\"UserName\">$userName</h3>
                <h4>Rating:</h4>
                <div class=\"stars-outer\">
                    <div class=\"stars-inner\" style=\"width:$ratingPercentage%;\"></div>
                </div><br>
                <h4>Review:</h4>
                <div class=\"reviewText\"> 
                $reviewText 
                </div>
                <hr class=\"reviewHR\">
                ";

                echo "<br>";
            }
        } else {
            echo "<p>No Reviews Found....</p>
            <br>";
        }
        echo "
                </section>
            </main>
            </div>
            ";
    } else {
        header("refresh:5;url=https://www.cps630.tech/Assignment/PHP/Assignment.php");
        die("<p>No Attraction with that ID (Attractiction ID: $attID)</p>");
    }

    $conn->close();
    echo "
    </body>
    </html>
    ";
?>

<?php

/**
 * @param $conn - Connection to DB
 * @param $attID - Attraction ID 
 * 
 * Helper Function to gather the total ratings for a provided attraction
 */

 function get_rating($conn, $attID){
    $stmt = $conn->prepare("SELECT rating FROM reviews WHERE AttractionID = ?");
    $stmt->bind_param("i", $attID);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
        $total = 0;
        while($row = $result->fetch_assoc()){
            $total += $row["rating"];
        }
        $stmt->close();
        return array (
            "totalRating" => $total,
            "totalRows" => $result->num_rows,
            "avg" => $total / ($result->num_rows)
        );
    } else {
        $stmt->close();
        return false;
    }
}
?>
