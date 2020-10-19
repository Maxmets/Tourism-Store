<?php
    // Load Autoload.php so you can use $dotenv
    require_once("/var/www/html/Assignment/PHP/vendor/autoload.php");

    // Load dotenv PHP Module (the '.env' file will overwrite any existing env variables)
    $dotenv = Dotenv\Dotenv::createMutable("/var/www/html/Assignment/");
    $dotenv->load();

    // Required ENV Variables
    $dotenv->required(['SERVER', 'DATABASE', 'DB_USER', 'DB_PASS']);

    // If no APP_ENV in the .env file, then default to PROD
    $APP_ENV = getenv('APP_ENV') ?: "PROD";

    // Set Env Variables
    $SERVER = getenv('SERVER');
    $DATABASE = getenv('DATABASE');
    $DB_USER = getenv('DB_USER');
    $DB_PASS = getenv('DB_PASS');

    // Connect to the MySQL database
    $conn = new mysqli($SERVER, $DB_USER, $DB_PASS, $DATABASE); 

    // If there is a connection error, exit
    if ($conn -> connect_error)
    {
        echo "<p>Connection Failed, Error:" . $conn -> connect_error . "</p>"; 
        die("Connection failed: " > $conn -> connect_error); 
    }

    if($APP_ENV == "dev"){
        echo "<p>Connection Successful.</p>";
    }

    if($APP_ENV == "dev"){
        // Display error logs
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
?>