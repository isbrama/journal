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

    //variables
    $id="";
    $diary="";
    $result="";
    $query="";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());
    }

    else{

        $query = "SELECT * FROM tableDiary WHERE id='".$_SESSION['id']."'";

        $result=mysqli_query($conn,$query);

        $row = mysqli_fetch_assoc($result);

        $diary=$row['diary'];


        if(isset($_POST['logout'])) {

            $diary=$_REQUEST['diary'];

            $query = "UPDATE tableDiary SET diary='".$diary."' WHERE id='".$_SESSION['id']."'";

            mysqli_query($conn,$query);

            header("location:index.php");

        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <button id="logout" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout" form="myForm">Logout</button>
    </nav>

    <div class="container-fluid">
          <h2>Write your ideas...</h1>
        <form id="myForm" method="post" >
            <div class="form-group journal">
                <textarea class="form-control journal" rows="15" name="diary" ><?php echo $diary;?></textarea>
            </div>
        </form>
    </div>

</body>

</html>
