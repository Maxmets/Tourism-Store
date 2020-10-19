<?php
    // Init Season
    session_start();

    // Get required php modules 
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");
    include_once("/var/www/html/Assignment/PHP/db_connect.php");

    $uri = $_SERVER[REQUEST_URI];

    // Checks if the user is not logged in, if so redirect to login page
    if(!isset($_SESSION["loggedin"]) || !isset($_SESSION["isAdmin"]) || $_SESSION["loggedin"] !== true || $_SESSION["isAdmin"] != true){
        header("location: /Assignment/PHP/Login.php?ref=$uri");
        exit;
    } else {
        if($APP_ENV == "dev"){
            var_dump($_SESSION);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      require_once("/var/www/html/Assignment/PHP/head.php");
    ?>
</head>
    
<style>
  #command {
    width: 490px;
  }   
</style>
    
    
</head>
<body>
    
<?php  
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $userName = $_POST["userName"];
  $password = $_POST["password"];
  $dbName = $_POST["dbName"];
  $command = $_POST["command"]; 
    
  $servername = "localhost";
  $database = $dbName; 
  $username = $userName;
  $password = $password; 
    
  $conn = new mysqli($servername, $username, $password, $database); 
    
  if ($conn -> connect_error)
  {
    echo "Connection Failed, Error:" . $conn -> connect_error; 
    die("Connection failed: " > $conn -> connect_error); 
  }
}
?>

<div class="title">Enter The DataBase Manager Information Below</div>

<?php
    require_once("/var/www/html/Assignment/PHP/navbar.php");
?>
    
<center>
<form action="#" method="post" >
<p>Username: </p>
<input type="text" placeholder="Enter your UserName" required name="userName">
    
<p>Password: </p>
<input type="password" placeholder="Enter your Password" required name="password"> 
    
<p>Database Name: </p>
<input type="text" placeholder="Enter Database Name" required name="dbName"> 
    
<p>Insert SQL Command Here:</p>

<?php
  $queryType = isset($_GET["queryType"]) ? $_GET["queryType"] : "";
  echo "
    <input id=\"command\" type=\"text\" placeholder=\"Insert SQL command here\" name=\"command\" value=\"$queryType \">
  ";
?>
<br>
<br>
    
<input type="submit">
<input type="reset">
    
</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $sql = $command; 
      
  //echo $sql; 
      
  echo "<h3> RESULTS:   </h3>";
      
  $result = mysqli_query($conn,$sql); 
      
      
  if (mysqli_num_rows($result) > 0)
  {
      echo "<br>";
      echo "<table style='border: 1px solid black'>"; 
      $rowInfo = mysqli_fetch_fields($result);
      echo "<tr>";
      foreach ($rowInfo as $val){
        $rowName = $val->name;
        echo "<th> $rowName </th>";
      }
      echo "</tr>";
      
      
      while ($row = mysqli_fetch_assoc($result)) { 
      echo "<tr>";
      foreach ($row as $field => $value) { 
          echo "<td>" . $value . "</td>"; 
      }
      echo "</tr>";
    
      }
      echo "</table>";   
  }    
  else 
  {
    echo "No result for query: " . $sql; 
  }
}
?>
    
</center>
    
</body>
</html>
