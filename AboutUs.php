<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <?php
        require_once("/var/www/html/Assignment/PHP/head.php");
    ?>
    </head>
    <body>
        <div class="title">About Us</div>
        <?php
            require_once("/var/www/html/Assignment/PHP/navbar.php");
        ?>
        <div>
            <div>
                <h2>Our Team: Group #15</h2>
            </div>
            <div class="container" id="slide">
                <h2 class="name">Noel Kocheril</h2>
                <p>Student Number: 500646641</p>
                <p>Email: <a href="mailto:Noel.Kocheril@Ryerson.ca">Noel.Kocheril@Ryerson.ca</a></p>
            </div>
            <div class="container" id="slide">
                <h2 class="name">Maksym Yakhymets</h2>
                <p>Student Number: 500838023</p>
                <p>Email: <a href="mailto:myakhymets@ryerson.ca">myakhymets@Ryerson.ca</a></p>
            </div>
            <div class="container padding" id="slide">
                <h2 class="name">Paul Messina</h2>
                <p>Student Number: 500831217</p>
                <p>Email: <a href="mailto:paul.messina@ryerson.ca">Paul.Messina@Ryerson.ca</a></p>
            </div>
        </div>
    </body>
</html>