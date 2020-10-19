<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
            require_once("/var/www/html/Assignment/PHP/head.php");
        ?>
        <script>
            $(document).ready(function(){

                $(".continentsList").on("change", function(){
                    $("#attractions").css("display","none");
                    $("#countries").css("display","inline");
                });

                $("#countries").on("change", function(){

                    $("#attractions").css("display","inline");
                });

                $(".popularPlace").on("change", function(){
                    $(".info").css("display","inline");
                    // alert("action");
                    $(".formSubmit").submit(); 
                });

                $("#attractions").on("change", function(){
                    $(".info").css("display","inline");
                    $(".formSubmit").submit(); 
                });

            });

            function countryList(listindex)
            {

                document.getElementById("countries").length = 0;
                
                var selectCountry = new Option("Select Country","");
                document.getElementById("countries").options[0]= selectCountry;
                selectCountry.setAttribute("disabled","");
                selectCountry.setAttribute("selected","");

                switch (listindex)
                {
                    case "1" :
                        document.getElementById("countries").options[1]=new Option("Canada","11");
                        break;

                    case "2" :
                        document.getElementById("countries").options[1]=new Option("Brazil","21");
                        break;
                    case "3" :
                        document.getElementById("countries").options[1]=new Option("France","31");
                        break;
                    case "4" :
                        document.getElementById("countries").options[1]=new Option("Japan","41");
                        break;
                    case "5" :
                        document.getElementById("countries").options[1]=new Option("Australia ","51");
                        break;
                }
                return true;
            }

            function attractionList(listindex)
            {
                document.getElementById("attractions").length = 0;

                var selectAttraction = new Option("Select Attraction","");
                document.getElementById("attractions").options[0]= selectAttraction;
                selectAttraction.setAttribute("disabled","");
                selectAttraction.setAttribute("selected","");

                switch (listindex)
                {
                    case "11" :
                        document.getElementById("attractions").options[1]=new Option("CN Tower","111");
                        document.getElementById("attractions").options[2]=new Option("Ripley's Aquarium","112");
                        document.getElementById("attractions").options[3]=new Option("Rogers  Centre","113");
                        document.getElementById("attractions").options[4]=new Option("Royal Ontario Museum","114");
                        break;

                    case "21" :
                        document.getElementById("attractions").options[1]=new Option("Christ the Redeemer","211");
                        document.getElementById("attractions").options[2]=new Option("Escadaria Selaron","212");
                        document.getElementById("attractions").options[3]=new Option("Santa Teresa","213");
                        document.getElementById("attractions").options[4]=new Option("Corcovado","214");
                        break;

                    case "31" :
                        document.getElementById("attractions").options[1]=new Option("Eiffel Tower","311");
                        document.getElementById("attractions").options[2]=new Option("Louvre Museum","312");
                        document.getElementById("attractions").options[3]=new Option("Cathedrale Notre-Dame De Paris","313");
                        document.getElementById("attractions").options[4]=new Option("Arc de Triomphe","314");
                        break;
                    case "41" :
                        document.getElementById("attractions").options[1]=new Option("Tokyo Skytree","411");
                        document.getElementById("attractions").options[2]=new Option("Tokyo Tower","412");
                        document.getElementById("attractions").options[3]=new Option("Senso-ji","413");
                        document.getElementById("attractions").options[4]=new Option("Shinjuku Gyoen National Garden","414");
                        break;
                    case "51" :
                        document.getElementById("attractions").options[1]=new Option("Sydney Opera House","511");
                        document.getElementById("attractions").options[2]=new Option("Sydney Harbour Bridge","512");
                        document.getElementById("attractions").options[3]=new Option("Taronga Zoo Sydney","513");
                        document.getElementById("attractions").options[4]=new Option("Royal Botanic Gardens","514");
                        break;
                }
                return true;
            }
        </script>
    </head>

    <body>
        <?php
            // Changed $conn info into db_connect.php so the info is not hard coded 
            require_once("/var/www/html/Assignment/PHP/db_connect.php");

            $continentID = isset($_POST['continents'])   ? $_POST['continents']  : ""; 
            $countryID = isset($_POST['countries'])      ? $_POST['countries']   : ""; 
            $attractionID = isset($_POST['attractions']) ? $_POST['attractions'] : ""; 
            $popularPlaceID = isset($_POST['popular'])   ? $_POST['popular']     : ""; 
            $searchQuery = isset($_POST['searchBar'])    ? $_POST['searchBar']   : "";
        ?>

        <div class="title">Plan Your Travel!</div>
        <?php
            require_once("/var/www/html/Assignment/PHP/navbar.php");
        ?>

        <br>
        <form class="formSubmit" method="post" action="#">

            <!--<form  class="formSubmit" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> -->

            <!-- REMEMBERS THE LAST ITEM THAT WAS SELECTED FROM THE DROP DOWN LIST  -->

            <div class="selectionContainer">

            <select class="popularPlace" name="popular">
                <option value="" selected disabled>Popular Places</option>
                <option value="111">CN Tower</option>    
                <option value="211">Christ the Redeemer</option> 
                <option value="311">Eiffel Tower</option> 
                <option value="411">Tokyo Skytree</option> 
                <option value="511">Sydney Opera House</option>  
            </select> 


            <select  class="continentsList" name="continents" onchange="javascript: countryList(this.options[this.selectedIndex].value);">
                <option value="" selected disabled>Select a Continent</option>
                <option value="1" <?php if($continentID == "1") echo("Selected"); ?>>North America</option>    
                <option value="2" <?php if($continentID == "2") echo("Selected"); ?>>South America</option> 
                <option value="3" <?php if($continentID == "3") echo("Selected"); ?>>Europe</option> 
                <option value="4" <?php if($continentID == "4") echo("Selected"); ?>>Asia</option> 
                <option value="5" <?php if($continentID == "5") echo("Selected"); ?>>Australia</option> 
            </select>   


            <select id="countries" name="countries" style="display: none" onchange="javascript: attractionList(this.options[this.selectedIndex].value);">
            </select> 

            <select id="attractions" name="attractions"  style="display: none">
            </select> 
            </div>
        </form>

        <?php

        // This is meant for when all three attractionID, countryID, and continentID is not empty
        if (!empty($attractionID) && !empty($countryID) && !empty($continentID))
        {

            $sql = "SELECT * FROM attractions where attractionID = $attractionID";

           // echo $sql; 

            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $selectedPlaceName = $row[1];
                    $selectedPlaceDesc = $row[2];
                    $selectedPlaceImg  = $row[6];
                    echo "
                    <div class='mainAttractionContainer'> 
                        <figure class='mainAttractionFigure' id='slide'>
                            <div class='imageContainer'>
                                <img src='$selectedPlaceImg' alt='$selectedPlaceName' class='mainAttractionImage'>
                            </div>
                            <h4>$selectedPlaceName</h4>
                            <figcaption>$selectedPlaceDesc</figcaption>
                            <a href='/Assignment/PHP/ReadMore.php?attID=$attractionID'>Read More...</a>
                        </figure> 
                    </div>";
                }
            }

            $sql = "SELECT * FROM attractions where NOT attractionID = $attractionID AND countryID = $countryID";

//            if($popularPlaceID == "")
//            {
//                echo "Popular Place is empty"; 
//            }

            //    AND attractions.'$countryID' = countries.'$countryID' AND countries.'$continentID' = continents.'$continentID'"; 

          //  echo $sql; 

            $result = mysqli_query($conn,$sql);

            echo "<div class='row'>";

            if (mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $attID  = $row[0];
                    $name   = $row[1];
                    $desc   = $row[2];
                    $src    = $row[6];
    
                    echo "
                    <div class='attractionContainer'> 
                        <figure class='attractionFigure' id='slide'>
                            <div class='imageContainer'>
                                <img src='$src' alt='$name' class='attractionImage'>
                            </div>
                            <h4>$name</h4>
                            <figcaption>$desc</figcaption>
                            <a href='/Assignment/PHP/ReadMore.php?attID=$attID'>Read More...</a>
                        </figure> 
                    </div>";
                }
            }

            echo  "</div>";

            echo "</div>";

        } elseif(!empty($popularPlaceID)) 
        {
            // This is meant to deal with Popular Place ID
            $sql = "SELECT * FROM attractions where attractionID = $popularPlaceID";

            //    AND attractions.'$countryID' = countries.'$countryID' AND countries.'$continentID' = continents.'$continentID'"; 

           // echo $sql; 

            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $popularPlaceName = $row[1];
                    $popularPlaceDesc = $row[2];
                    $popularPlaceImg  = $row[6];
   
                   echo "
                   <div class='mainAttractionContainer'> 
                       <figure class='mainAttractionFigure' id='slide'>
                           <div class='imageContainer'>
                               <img src='$popularPlaceImg' alt='$popularPlaceName' class='mainAttractionImage'>
                           </div>
                           <h4>$popularPlaceName</h4>
                           <figcaption>$popularPlaceDesc</figcaption>
                           <a href='/Assignment/PHP/ReadMore.php?attID=$popularPlaceID'>Read More...</a>
                       </figure> 
                   </div>";
                }
            }

            $countryID2 = "SELECT countryID FROM attractions where  attractionID = $popularPlaceID";

           // echo $countryID2; 

            $sql = "SELECT * FROM attractions WHERE attractionID BETWEEN $popularPlaceID and $popularPlaceID + 100 - 1 AND NOT attractionID = $popularPlaceID";

            //    AND attractions.'$countryID' = countries.'$countryID' AND countries.'$continentID' = continents.'$continentID'"; 

           // echo $sql; 

            $result = mysqli_query($conn,$sql);

            echo "<div class='row'>";

            if (mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $attID  = $row[0];
                    $name   = $row[1];
                    $desc   = $row[2];
                    $src    = $row[6];
    
                    echo "
                    <div class='attractionContainer'> 
                        <figure class='attractionFigure' id='slide'>
                            <div class='imageContainer'>
                                <img src='$src' alt='$name' class='attractionImage'>
                            </div>
                            <h4>$name</h4>
                            <figcaption>$desc</figcaption>
                            <a href='/Assignment/PHP/ReadMore.php?attID=$attID'>Read More...</a>
                        </figure> 
                    </div>";
                }
            }
            echo  "</div>";

            echo "</div>";

        } elseif(!empty($searchQuery)){
            
            // This is meant to deal with the search Bar query 
            
            $table = [];

            $table = $table + getLikeContinent($table, $searchQuery, $conn);
            $table = $table + getLikeCountry($table, $searchQuery, $conn);
            $table = $table + getLikeAttraction($table, $searchQuery, $conn);

            if($APP_ENV == "dev"){
                echo "<br>";
                // print_r($table);
                foreach(array_keys($table) as $key){
                    $val = $table[$key];
                    echo "<p><b>$key: </b>";
                    print_r($val);
                    echo "</p>";
                }
            }

            echo "
            <br>";
            foreach(array_keys($table) as $key){
                $info   = $table[$key];

                $attID  = $info[0];
                $name   = $info[1];
                $desc   = $info[2];
                $src    = $info[6];

                echo "
                <div class='attractionContainer'> 
                    <figure class='attractionFigure' id='slide'>
                        <div class='imageContainer'>
                            <img src='$src' alt='$name' class='attractionImage'>
                        </div>
                        <h4>$name</h4>
                        <figcaption>$desc</figcaption>
                        <a href='/Assignment/PHP/ReadMore.php?attID=$attID'>Read More...</a>
                    </figure> 
                </div>";
            }
        }

        ?>
    </body>

</html>

<?php
    function getLikeContinent($table=[], $query, $conn){
        
        $t = $table;
        $param_q = "%".$query."%";

        $q = "SELECT ContinentID FROM continents WHERE NameOfContinent LIKE ?";
        // echo "$q";
        if($stmt = $conn->prepare($q)){
            $stmt->bind_param("s", $param_q);
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = $result->fetch_array()){
                    $cID = $row[0]."%";
                    $attractionQ = "SELECT * FROM attractions WHERE AttractionID LIKE ?";
                    if($attractionStmt = $conn->prepare($attractionQ)){
                        $attractionStmt->bind_param("s", $cID);
                        if($attractionStmt->execute()){
                            $attractionResult = $attractionStmt->get_result();
                            while($attractionRow = $attractionResult->fetch_array()){
                                $aID = $attractionRow["AttractionID"];
                                $new = [$aID => $attractionRow];
                                $t = $t + $new;
                            }
                        }
                    }
                }
            }
        }
        return $t;
    }

    function getLikeCountry($table=[], $query, $conn){
        
        $t = $table;
        $param_q = "%".$query."%";

        $q = "SELECT CountryID FROM countries WHERE NameOfCountry LIKE ?";
        // echo "$q";
        if($stmt = $conn->prepare($q)){
            $stmt->bind_param("s", $param_q);
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = $result->fetch_array()){
                    $cID = $row[0]."%";
                    $attractionQ = "SELECT * FROM attractions WHERE AttractionID LIKE ?";
                    if($attractionStmt = $conn->prepare($attractionQ)){
                        $attractionStmt->bind_param("s", $cID);
                        if($attractionStmt->execute()){
                            $attractionResult = $attractionStmt->get_result();
                            while($attractionRow = $attractionResult->fetch_array()){
                                $aID = $attractionRow["AttractionID"];
                                $new = array($aID => $attractionRow);
                                $t = $t + $new;
                            }
                        }
                    }
                }
            }
        }
        return $t;
    }

    function getLikeAttraction($table=[], $query, $conn){
        $t = $table;
        $param_q = "%".$query."%";

        $q = "SELECT * FROM attractions WHERE NameOfAttraction LIKE ?";
        if($stmt = $conn->prepare($q)){
            $stmt->bind_param("s", $param_q);
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = $result->fetch_array()){
                    $aID = $row["AttractionID"];
                    $new = array($aID => $row);            
                    $t = $t + $new;
                }
            }
        }
        return $t;
    }
?>