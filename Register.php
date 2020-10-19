<?php
    require_once("/var/www/html/Assignment/PHP/db_connect.php");
    $name = $email = $username = $password = $confirm_password = "";
    $name_err = $email_err = $username_err = $password_err = $confirm_password_err = "";
    $min_pass_len = 8;
    $min_pass_req = 3;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate Name
        if(empty(trim($_POST["name"]))){
            $name_err = "Full name Required.";
        } else {
            $name = trim($_POST["name"]);
        }
        
        //Validate Email
         if(empty(trim($_POST["email"]))){
            $email_err = "Email Required.";
        } else {
             // need to check if email is already taken or valid. 
        }
        
        // Validate Username
        if(empty(trim($_POST["username"]))){
            $username_err = "Username Required.";
        } else {
            $q = "SELECT UserID FROM users WHERE UserName = ?";
            if($stmt = $conn->prepare($q)){
                // Bind variables to prepared statement
                $stmt->bind_param("s", $param_username);
                // Set Params
                $param_username = trim($_POST["username"]);

                if($stmt->execute()){
                    $result = $stmt->get_result();
                    if($result->num_rows == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                        if($APP_ENV == "dev"){
                            echo "This username $username is available.<br><br>";
                        }
                    }
                } else {
                    echo "<p> Oops! Something went wrong, Please try again later. </p>";
                }
                $stmt->close();
            }
        }

        $post_pass = trim($_POST["password"]);

        // Check if password contains the following:
        $uppercase      = preg_match('@[A-Z]@', $post_pass);
        $lowercase      = preg_match('@[a-z]@', $post_pass);
        $number         = preg_match('@[0-9]@', $post_pass);
        $specialChars   = preg_match('@[^\w]@', $post_pass);

        $length         = ($min_pass_len <= strlen($post_pass)) ? 0 : 1;

        if($APP_ENV == "dev"){
            echo "Does the password contain <br>
            <b>uppercase:</b> uppercase, <br>
            <b>lowercase:</b> $lowercase, <br>
            <b>number:</b> $number, <br>
            <b>special character:</b> $specialChars, <br>
            <b>length below $min_pass_len:</b> $length <br>";
        }

        // Validate Password
        if(empty($post_pass)){
            $password_err = "Please enter a password.";
        } elseif($length) {
            $password_err = "Password must have atleast $min_pass_len characters.";
        } elseif(($uppercase + $lowercase + $number + $specialChars) < $min_pass_req) {
            $password_err = "Password must have atleast $min_pass_req of the following:<br><ul><li>Uppercase</li><li>Lowercase</li><li>Number</li><li>Special Character</li><ul>";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        // Check if there were any errors prior to inserting data
        if(empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            $q = "INSERT INTO users (NameOfUser, UserName, PasswordOfUser, email) VALUES (?, ?, ?, ?)";
            if($stmt = $conn->prepare($q)){
                $stmt->bind_param("sss", $param_name, $param_username, $param_password, $param_email);

                $param_name     = $name;
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $param_email = $email;

                if($stmt->execute()){
                    header("location: /Assignment/PHP/Login.php");
                } else {
                    echo "<p> Oops! Something went wrong. Please try again later. </p>";
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <?php
        require_once("/var/www/html/Assignment/PHP/head.php");
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="/Assignment/PHP/Login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
