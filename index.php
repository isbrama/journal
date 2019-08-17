<?php
    session_start();
    //Database Info
    $servername = "shareddb-j.hosting.stackcp.net";
    $username = "dbdiary-39359729";
    $password = "caracas30!";
    $dbname = "dbdiary-39359729";

    //Message to user
    $error="";
    $success="";

    // define variables and set to empty value
    $email="";
    $psw="";
    $query="";
    $result="";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());
    }

    else{

        if(isset($_POST['signUp'])) {

            $email=$_POST['email'];
            $psw=$_POST['psw'];

            if(empty($email)||empty($psw)){

                if(empty($email)){

                    $error .= "Email is required. <br> ";

                }

                if(empty($psw)){

                    $error .= "Password is required.  <br>";

                }
            }

            else{

                //Check email adress is a valid format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                }

                else{

                //Check if the table has already the same email adress
                $query = "SELECT `id` FROM `tableDiary` WHERE email = '".mysqli_real_escape_string($conn, $email)."'";

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error="That email address has already been taken.";

                }

                else{

                $query = "INSERT INTO tableDiary (email, password) VALUES ('$email', '$psw')";

                if (mysqli_query($conn, $query)) {

                    $success="New record created successfully.";

                    }

                else{

                    $error="<div class='alert alert-danger' role='alert'>Error:".$sql."<br>".mysqli_error($conn)."</div>";

                    }
                }
              }
            }
        }

        //User press Login Button
         if(isset($_POST['login'])) {

            $email=$_POST['email'];
            $psw=$_POST['psw'];

            if(empty($email)||empty($psw)){

                if(empty($email)){

                    $error .= "Email is required. <br> ";

                }

                if(empty($psw)){

                    $error .= "Password is required.  <br>";

                }
            }

            else{

                $sql="SELECT id,email,password FROM tableDiary WHERE email='".$email."' AND password = '".$psw."'";


                if ($result=mysqli_query($conn,$sql)){

                        $row = mysqli_fetch_assoc($result);

                        if($email==$row['email'] && $psw==$row['password']){

                            //set session id
                            $_SESSION['id'] = $row['id'];

                            header("location:journal.php");

                            }

                        else{

                            $error="Plese verify your Email and Password.";
                        }
                }
            }

        }//fin if Login

    }//fin 1st if


    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

    <!--JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/script.js" charset="utf-8"></script>
</head>

<body>

    <div class="container">
        <h1>My Journal</h1>
        <p>Keep your ideas forever, and securely.</p>
        <center>
            <div class="message">
                <?php

                    if ($success) {

                            echo '<div class="alert alert-success" role="alert">'.$success.'</div>';

                    } else if ($error) {

                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
              }
              ?>
            </div>
        </center>

        <p class="signUpNow">SIGN UP NOW.</p>

        <p class="loginNow">Log in with your username and password.</p>

        <form method="post">

            <div class="form-group">
                <center><input type="email" class="form-control" id="email" placeholder="Your Email" name="email"></center>
            </div>
            <div class="form-group">
                <center><input type="password" class="form-control" id="password" placeholder="Password" name="psw"></center>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="staylogin"> Stay logged in
                </label>
            </div>
            <button type="submit" class="btn btn-success btnSingUp" name="signUp">Sing Up!</button>
            <button type="submit" class="btn btn-success btnLogin" name="login">Log In!</button>

            <p class="login">Log in</p>

            <p class="signUp">Sign up</p>

        </form>
    </div>
</body>
</html>
