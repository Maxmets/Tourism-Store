<?php
    session_start();

    $goto = isset($_GET["ref"]) ? $_GET["ref"] : "/Assignment/PHP/Assignment.php";

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: $goto");
        exit;
    }

    require_once("/var/www/html/Assignment/PHP/db_connect.php");

    $username = $password = "";
    $username_err = $password_err = "";

    // Check if username is empty
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if username is empty
        $post_username = trim($_POST["username"]);
        if(empty($post_username)){
            $username_err = "Please enter username.";
        } else{
            $username = $post_username;
        }

        // Check if password is empty
        $post_pass = trim($_POST["password"]);
        if(empty($post_pass)){
            $password_err = "Please enter Password.";
        } else{
            $password = $post_pass;
        }

        $goto = $_POST["goto"];

        // Validate Credentials 
        if(empty($username_err) && empty($password_err)){
            $q = "SELECT UserID, UserName, PasswordOfUser, isAdmin FROM users WHERE UserName = ?";
            if($stmt = $conn->prepare($q)){
                $stmt->bind_param("s", $param_username);
                $param_username = $username;
                
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    if($result->num_rows == 1){
                        if($row = $result->fetch_assoc()){
                            $userID = $row["UserID"];
                            $username = $row["UserName"];
                            $hashed_password = $row["PasswordOfUser"];
                            $isAdmin = $row["isAdmin"];

                            if($APP_ENV == "dev"){
                                echo "<p><b>UserID:</b> $userID </p><br>
                                <p><b>UserName:</b> $username </p><br>
                                <p><b>Hash_Pass:</b> $hashed_password </p><br>
                                <p><b>isAdmin:</b> $isAdmin </p><br>";
                            }

                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $userID;
                                $_SESSION["username"] = $username;
                                $_SESSION["isAdmin"] = $isAdmin;
                                
                                header("location: $goto");

                            } else {
                                $username_err = "That Username and Password pair does not exist within our system.";    
                            }
                        } else {
                            $username_err = "That Username and Password pair does not exist within our system.";    
                        }
                    } else {
                        // No Account with that Username exit
                        $username_err = "That Username and Password pair does not exist within our system.";
                    }
                } else {
                    echo "<p> Oops! Something went wrong, Please try again later. </p>";
                }

            } else {
                echo "<p> Oops! Something went wrong. Please try again later. </p>";
            }
            $stmt->close();
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once("/var/www/html/Assignment/PHP/head.php");
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

</head>
<body>
    <div class="title">Login</div>
    <?php
        require_once("/var/www/html/Assignment/PHP/navbar.php");
    ?>
    <div class="wrapper">
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group" style="display:none;">
                <input type="text" name="goto" class="form-control" value=" <?php echo $goto; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="loginButton" value="Login">
            </div>
            <p>Don't have an account? <a href="/Assignment/PHP/Register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>