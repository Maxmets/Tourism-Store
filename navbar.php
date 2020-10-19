<?php

$userContent = "";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username = $_SESSION['username'];
    $userContent = "
    <div>Hello, $username</div>
    <a href=\"/Assignment/PHP/Profile.php\">Profile</a>
    <a href=\"/Assignment/PHP/Logout.php\">Log out</a>
    ";
} else {
    $userContent = "
    <a href=\"/Assignment/PHP/Login.php\">Login</a>
    <a href=\"/Assignment/PHP/Register.php\">Register</a>
    ";
}


echo "
<div class=\"navbar\">
<div class=\"dropdown\">
    <button class=\"dropbtn\"><i class=\"fas fa-user\"></i></button>
    <div class=\"dropdown-content\">
        $userContent
    </div>
</div>
<a href=\"/Assignment/PHP/Assignment.php\">Home</a>
<a href=\"/Assignment/PHP/AboutUs.php\">About Us</a>
<a href=\"/Assignment/PHP/ContactUs.php\">Contact Us</a>
<div class=\"dropdown\">
    <button class=\"dropbtn\">DB Maintain 
        <i class=\"fas fa-caret-down\"></i>
    </button>
    <div class=\"dropdown-content\">
        <a href=\"/Assignment/PHP/dbManager.php?queryType=INSERT\">Insert</a>
        <a href=\"/Assignment/PHP/dbManager.php?queryType=DELETE\">Delete</a>
        <a href=\"/Assignment/PHP/dbManager.php?queryType=SELECT\">Select</a>
        <a href=\"/Assignment/PHP/dbManager.php?queryType=UPDATE\">Update</a>
        <a href=\"/Assignment/PHP/dbManager.php\">Other</a>
    </div>
</div> 
<a href=\"/Assignment/PHP/shoppingCart.php\"><i class=\"fas fa-shopping-cart\"></i></a>
<div class=\"search-container\">
    <form method=\"post\" action=\"/Assignment/PHP/Assignment.php\">
        <input type=\"text\" name=\"searchBar\" placeholder=\"Search..\">
        <button type=\"submit\"><i class=\"fas fa-search\"></i></button>
    </form>
</div>
</div>
";
?>
