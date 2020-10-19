<?php
    // Get required php modules 
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");
    include_once("/var/www/html/Assignment/PHP/db_connect.php");

    // Init Season
    session_start();

    $uri = $_SERVER[REQUEST_URI];

    // Redirect to the login page if user is not logged in
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: /Assignment/PHP/Login.php?ref=$uri");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require_once("/var/www/html/Assignment/PHP/head.php");    
        ?>
        <script> 

            $(document).ready(function(){

                $("#planRadio1").on("click", function(){
                    $(".column").css("display","inline"); 

                    var agesEmpty = $("#agesInput").val(); 
                    
                    $(".map").attr("src", "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d155189.6700290332!2d-79.45335679964437!3d43.718127456131384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb90d7c63ba5%3A0x323555502ab4c477!2sToronto%2C%20ON!5e0!3m2!1sen!2sca!4v1582751398403!5m2!1sen!2sca");
                                   
                    $(".map").css("display","inline"); 

                    if(agesEmpty == "")
                    {

                        $("#agesInput").on("input", function(){

                            $(".invoice").css("display","block");

                            var numberOfTravelers =  $("#numberTravel").val(); 

                            var priceOfPlan = $("#planPrice1").attr("data-price");

                            var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                            var tax = 1.13; 

                            var totalCost = tax * totalCostnoTax; 

                            $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                            var cost =  totalCost;
                            document.getElementById('totalCost1').value = cost;

                            var name =  $("#name").val();    
                            var userID = $("#userID").val();  
                            var numberOfTravellers = $("#numberTravel").val();
                            var ages = $("#agesInput").val(); 

                            var tourNumber = $("#tourNumber1").attr("data-tourNumber");
                            var startDate = $("#startDate1").attr("data-startDate");
                            var duration = $("#duration1").attr("data-duration");
                            var airFare = $("#airFare1").attr("data-airFare");
                            var cruiseFare = $("#cruiseFare1").attr("data-cruiseFare");

                            $("#invoiceName").html(name);
                            $("#invoiceUserID").html(userID);
                            $("#invoiceTourNumber").html(tourNumber);
                            $("#invoiceStartDate").html(startDate);
                            $("#invoiceDuration").html(duration + " days");
                            $("#invoiceNumberTravellers").html(numberOfTravellers);
                            $("#invoiceNumberAges").html(ages);
                            $("#invoiceAirFare").html("$" + airFare + " per person");
                            $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                        });
                    }

                    else {
                        var numberOfTravelers =  $("#numberTravel").val(); 

                        var priceOfPlan = $("#planPrice1").attr("data-price");

                        var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                        var tax = 1.13; 

                        var totalCost = tax * totalCostnoTax; 

                        $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                        var cost =  totalCost;
                        document.getElementById('totalCost1').value = cost;

                        var name =  $("#name").val();    
                        var userID = $("#userID").val();  
                        var numberOfTravellers = $("#numberTravel").val();
                        var ages = $("#agesInput").val(); 

                        var tourNumber = $("#tourNumber1").attr("data-tourNumber");
                        var startDate = $("#startDate1").attr("data-startDate");
                        var duration = $("#duration1").attr("data-duration");
                        var airFare = $("#airFare1").attr("data-airFare");
                        var cruiseFare = $("#cruiseFare1").attr("data-cruiseFare");

                        $("#invoiceName").html(name);
                        $("#invoiceUserID").html(userID);
                        $("#invoiceTourNumber").html(tourNumber);
                        $("#invoiceStartDate").html(startDate);
                        $("#invoiceDuration").html(duration + " days");
                        $("#invoiceNumberTravellers").html(numberOfTravellers);
                        $("#invoiceNumberAges").html(ages);
                        $("#invoiceAirFare").html("$" + airFare + " per person");
                        $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                    }

                });

                $("#planRadio2").on("click", function(){
                    $(".column").css("display","inline"); 

                    var agesEmpty = $("#agesInput").val(); 
                    
                    $(".map").attr("src", "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d207446.24819652562!2d139.6007842640055!3d35.66844146191365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b857628235d%3A0xcdd8aef709a2b520!2sTokyo%2C%20Japan!5e0!3m2!1sen!2sca!4v1582751702324!5m2!1sen!2sca");
//                                   
                    $(".map").css("display","inline"); 
                    

                    if(agesEmpty == "")
                    {

                        $("#agesInput").on("input", function(){

                            $(".invoice").css("display","block");

                            var numberOfTravelers =  $("#numberTravel").val(); 

                            var priceOfPlan = $("#planPrice2").attr("data-price");

                            var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                            var tax = 1.13; 

                            var totalCost = tax * totalCostnoTax; 

                            $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                            var cost =  totalCost;
                            document.getElementById('totalCost1').value = cost;

                            var name =  $("#name").val();    
                            var userID = $("#userID").val();  
                            var numberOfTravellers = $("#numberTravel").val();
                            var ages = $("#agesInput").val(); 

                            var tourNumber = $("#tourNumber2").attr("data-tourNumber");
                            var startDate = $("#startDate2").attr("data-startDate");
                            var duration = $("#duration2").attr("data-duration");
                            var airFare = $("#airFare2").attr("data-airFare");
                            var cruiseFare = $("#cruiseFare2").attr("data-cruiseFare");

                            $("#invoiceName").html(name);
                            $("#invoiceUserID").html(userID);
                            $("#invoiceTourNumber").html(tourNumber);
                            $("#invoiceStartDate").html(startDate);
                            $("#invoiceDuration").html(duration + " days");
                            $("#invoiceNumberTravellers").html(numberOfTravellers);
                            $("#invoiceNumberAges").html(ages);
                            $("#invoiceAirFare").html("$" + airFare + " per person");
                            $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                        });
                    }

                    else {
                        var numberOfTravelers =  $("#numberTravel").val(); 

                        var priceOfPlan = $("#planPrice2").attr("data-price");

                        var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                        var tax = 1.13; 

                        var totalCost = tax * totalCostnoTax; 

                        $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                        var cost =  totalCost;
                        document.getElementById('totalCost1').value = cost;

                        var name =  $("#name").val();    
                        var userID = $("#userID").val();  
                        var numberOfTravellers = $("#numberTravel").val();
                        var ages = $("#agesInput").val(); 

                        var tourNumber = $("#tourNumber2").attr("data-tourNumber");
                        var startDate = $("#startDate2").attr("data-startDate");
                        var duration = $("#duration2").attr("data-duration");
                        var airFare = $("#airFare2").attr("data-airFare");
                        var cruiseFare = $("#cruiseFare2").attr("data-cruiseFare");

                        $("#invoiceName").html(name);
                        $("#invoiceUserID").html(userID);
                        $("#invoiceTourNumber").html(tourNumber);
                        $("#invoiceStartDate").html(startDate);
                        $("#invoiceDuration").html(duration + " days");
                        $("#invoiceNumberTravellers").html(numberOfTravellers);
                        $("#invoiceNumberAges").html(ages);
                        $("#invoiceAirFare").html("$" + airFare + " per person");
                        $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                    }

                });

                $("#planRadio3").on("click", function(){
                    $(".column").css("display","inline"); 

                    var agesEmpty = $("#agesInput").val(); 
                    
                     $(".map").attr("src", "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252194.46014030566!2d150.94741763002438!3d-33.848820605794714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b129838f39a743f%3A0x3017d681632a850!2sSydney%20NSW%2C%20Australia!5e0!3m2!1sen!2sca!4v1582751727906!5m2!1sen!2sca");
                                   
                    $(".map").css("display","inline"); 
                    

                    if(agesEmpty == "")
                    {

                        $("#agesInput").on("input", function(){

                            $(".invoice").css("display","block");

                            var numberOfTravelers =  $("#numberTravel").val(); 

                            var priceOfPlan = $("#planPrice3").attr("data-price");

                            var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                            var tax = 1.13; 

                            var totalCost = tax * totalCostnoTax;         

                            $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                            var cost =  totalCost;
                            document.getElementById('totalCost1').value = cost;

                            var name =  $("#name").val();    
                            var userID = $("#userID").val();  
                            var numberOfTravellers = $("#numberTravel").val();
                            var ages = $("#agesInput").val(); 

                            var tourNumber = $("#tourNumber3").attr("data-tourNumber");
                            var startDate = $("#startDate3").attr("data-startDate");
                            var duration = $("#duration3").attr("data-duration");
                            var airFare = $("#airFare3").attr("data-airFare");
                            var cruiseFare = $("#cruiseFare3").attr("data-cruiseFare");

                            $("#invoiceName").html(name);
                            $("#invoiceUserID").html(userID);
                            $("#invoiceTourNumber").html(tourNumber);
                            $("#invoiceStartDate").html(startDate);
                            $("#invoiceDuration").html(duration + " days");
                            $("#invoiceNumberTravellers").html(numberOfTravellers);
                            $("#invoiceNumberAges").html(ages);
                            $("#invoiceAirFare").html("$" + airFare + " per person");
                            $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                        });
                    }

                    else {
                        var numberOfTravelers =  $("#numberTravel").val(); 

                        var priceOfPlan = $("#planPrice3").attr("data-price");

                        var totalCostnoTax = numberOfTravelers * priceOfPlan; 

                        var tax = 1.13; 

                        var totalCost = tax * totalCostnoTax;         

                        $("#totalCost").html( "$" +  totalCost.toFixed(2) + " , tax included.");

                        var cost =  totalCost;
                        document.getElementById('totalCost1').value = cost;

                        var name =  $("#name").val();    
                        var userID = $("#userID").val();  
                        var numberOfTravellers = $("#numberTravel").val();
                        var ages = $("#agesInput").val(); 

                        var tourNumber = $("#tourNumber3").attr("data-tourNumber");
                        var startDate = $("#startDate3").attr("data-startDate");
                        var duration = $("#duration3").attr("data-duration");
                        var airFare = $("#airFare3").attr("data-airFare");
                        var cruiseFare = $("#cruiseFare3").attr("data-cruiseFare");

                        $("#invoiceName").html(name);
                        $("#invoiceUserID").html(userID);
                        $("#invoiceTourNumber").html(tourNumber);
                        $("#invoiceStartDate").html(startDate);
                        $("#invoiceDuration").html(duration + " days");
                        $("#invoiceNumberTravellers").html(numberOfTravellers);
                        $("#invoiceNumberAges").html(ages);
                        $("#invoiceAirFare").html("$" + airFare + " per person");
                        $("#invoiceCruiseFare").html("$" + cruiseFare + " per person");

                    }

                });   

                function mySubmit() {
                    document.getElementById("shopForm").submit();
                }

                $(".reset").on("click", function(){

                    $(".invoice").css("display","none");
                });

            });

        </script>
    </head>

    <body>
        <?php
        $userID = $_POST["userID"]; 
        $planID = $_POST["planSelected"]; 
        $numberOfTravelers = $_POST["numberTravelers"];
        $totalCost = $_POST["costTotal"]; 
        $ages = $_POST["ages"]; 
        $name = $_POST["name"];

        $randomPurchaseID = rand();  

        //echo "The info sent is" . $name . " " . $userID . " " . $planID . " " . $numberOfTravelers . " " . $totalCost . " " . $ages . " Random number is: " . $randomPurchaseID;  
        //echo "<br>";

        $sql = "INSERT INTO purchases(PurchaseID,ages,Cost,NumberOfTravellers,PlanID) VALUES ('$randomPurchaseID' , '$ages' , '$totalCost' , '$numberOfTravelers' , '$planID')";  

        if($conn->query($sql) === TRUE) {
            echo "New Record created succesfully";
        }
        //    else {
        //        echo "Error: " . $sql . "<br>" . $conn->error; 
        //    }

        $sql = "INSERT INTO users(userID,NameOfUser,PurchaseID) VALUES ('$userID' , '$name' , '$randomPurchaseID')";  

        if($conn->query($sql) === TRUE) {
            echo "New Record created succesfully";
        }
        //    else {
        //        echo "Error: " . $sql . "<br>" . $conn->error; 
        //    }
        //    

        // GOING TO BE USEFUL FOR CHECKING IF RECORD WAS ALREADY CREATED 

        //  SELECT * FROM users , purchases, plans WHERE users.purchaseID = purchases.purchaseID AND plans.planID = purchases.planID;

        ?>

        <?php
            echo "
            <div class=\"title\"> Shopping Cart </div>
            ";
            require_once("/var/www/html/Assignment/PHP/navbar.php");
        ?>

        <div class="row">
            <form id="shopForm" method="post" action="#" onclick="mySubmit()">
                <div class="column">

                    <?php
                    $sql = "SELECT plans.* , attractions.City  FROM plans, attractions WHERE Destination = 111 AND Destination = attractionID;";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0)
                    {

                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<div class='plansContainer' id='slide'>";
                            echo "<h3>" . $row[8] . "</h3>"; 
                            echo "<p id='startDate1' data-startDate=" . $row[1] . "> Start Date: ". $row[1]  ."</p>";
                            echo "<p id='duration1' data-duration=" . $row[2] . "> Duration: " . $row[2]  . "</p>";
                            echo "<p id='airFare1' data-airFare=" . $row[3] . "> Air Fare: $" . $row[3] . " per person</p>";
                            echo "<p id='cruiseFare1' data-cruiseFare=" . $row[4] . "> Cruise Fare: $" . $row[4] . " per person</p>";
                            echo "<p id='tourNumber1' data-tourNumber=" . $row[5] . "> Tour Number: " . $row[5] . "</p>";
                            echo "<p id='planPrice1' data-price=" . $row[6] . "> Price: $" . $row[6] ." per person</p>";
                            echo "<input id='planRadio1' type='radio' name='planSelected' value=" . $row[0] . ">"; 
                            echo "</div>";
                        }

                    }

                    $sql = "SELECT plans.* , attractions.City  FROM plans, attractions WHERE Destination = 411 AND Destination = attractionID;";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0)
                    {

                        while($row = mysqli_fetch_array($result))
                        {

                            echo "<div class='plansContainer' id='slide'>";
                            echo "<h3>" . $row[8] . "</h3>"; 
                            echo "<p id='startDate2' data-startDate=" . $row[1] . "> Start Date: ". $row[1]  ."</p>";
                            echo "<p id='duration2' data-duration=" . $row[2] . "> Duration: " . $row[2]  . "</p>";
                            echo "<p id='airFare2' data-airFare=" . $row[3] . "> Air Fare: $" . $row[3] . " per person</p>";
                            echo "<p id='cruiseFare2' data-cruiseFare=" . $row[4] . "> Cruise Fare: $" . $row[4] . " per person</p>";
                            echo "<p id='tourNumber2' data-tourNumber=" . $row[5] . "> Tour Number: " . $row[5] . "</p>";
                            echo "<p id='planPrice2' data-price=" . $row[6] . "> Price: $" . $row[6] ." per person</p>";
                            echo "<input id='planRadio2' type='radio' name='planSelected' value=" . $row[0] . ">"; 
                            echo "</div>";
                        }

                    }

                    $sql = "SELECT plans.* , attractions.City  FROM plans, attractions WHERE Destination = 511 AND Destination = attractionID;";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0)
                    {

                        while($row = mysqli_fetch_array($result))
                        {

                            echo "<div class='plansContainer' id='slide'>";
                            echo "<h3>" . $row[8] . "</h3>"; 
                            echo "<p id='startDate3' data-startDate=" . $row[1] . "> Start Date: ". $row[1]  ."</p>";
                            echo "<p id='duration3' data-duration=" . $row[2] . "> Duration: " . $row[2]  . "</p>";
                            echo "<p id='airFare3' data-airFare=" . $row[3] . "> Air Fare: $" . $row[3] . " per person</p>";
                            echo "<p id='cruiseFare3' data-cruiseFare=" . $row[4] . "> Cruise Fare: $" . $row[4] . " per person</p>";
                            echo "<p id='tourNumber3' data-tourNumber=" . $row[5] . "> Tour Number: " . $row[5] . "</p>";
                            echo "<p id='planPrice3' data-price=" . $row[6] . "> Price: $" . $row[6] ." per person</p>";
                            echo "<input id='planRadio3' type='radio' name='planSelected' value=" . $row[0] . ">"; 
                            echo "</div>";
                        }

                    }

                    ?>

                </div>

                <div class="column" style="display: none; height: 100%">
                    <h4>Enter Details to Purchase a Plan:</h4>
                    Name: <input type="text" name="name" id="name" placeholder="Enter your Name" required><br>
                    User ID: <input type="text" name="userID" id="userID" placeholder="Enter your User ID" required pattern="[0-9]*"><br>
                    Number of Travelers: <input type="text" id="numberTravel" name="numberTravelers" placeholder="Enter the Number of Travelers" required pattern="[0-9]*"><br>
                    Ages: <input type="text" id="agesInput" name="ages" placeholder="Enter the Ages" required><br>
                    <input type="hidden" id= 'totalCost1' name='costTotal' value='' >
                    <input type="submit">
                    <input class="reset" type="reset">
                    <h3>Map:</h3>
                    <iframe class="map" src="" width="100%" height="500px" frameborder="0" style="border:1; display: none;" allowfullscreen=""></iframe>
                </div>

                <div class="column">
                    <div class="invoice" id="slide">
                        <h2>Invoice</h2>
                        <h4>Name: </h4>
                        <p id="invoiceName"></p>
                        <h4>UserID: </h4>
                        <p id="invoiceUserID"></p>
                        <h4>Tour Number: </h4>
                        <p id="invoiceTourNumber"></p>
                        <h4>Start Date: </h4>
                        <p id="invoiceStartDate"></p>
                        <h4>Duration: </h4>
                        <p id="invoiceDuration"></p>
                        <h4>Number of Travellers: </h4>
                        <p id="invoiceNumberTravellers"></p>
                        <h4>Ages: </h4>
                        <p id="invoiceNumberAges"></p>
                        <h4>Air Fare: </h4>
                        <p id="invoiceAirFare"></p>
                        <h4>Cruise Fare: </h4>
                        <p id="invoiceCruiseFare"></p>
                        <h4>Price(including tax): </h4>
                        <p id="totalCost"></p>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>