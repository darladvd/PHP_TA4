<!DOCTYPE html>  
<html>  
<head>

	 <!--  meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Panel</title>  
    <style> 
    h1, p
    {
        font-family: Montserrat, sans-serif;
        text-align: left;
    }

    table
    {
        font-family: Montserrat, sans-serif;      
        /* height: 500px; */
        /* width: 800px; */
        border: 5px solid #1F4172;
        border-radius: 4px;
    }

    img
    {
        height: 200px;
    }
    </style>  
</head>

<body>
    <?php
    session_start();
        // if (!isset($_SESSION['username']) || !isset($_SESSION['password']))
        // {
		// 	header("Location: login.php");
		// }
		// elseif ($_SESSION['userlevel'] == "user")
        // {
		// 	header("Location: user_home.php");
		// }

        $username = $_SESSION['username'];

        $conn = mysqli_connect('localhost','root','','ta4');

        if($conn->connect_error)
        {
            echo "$conn->connect_error";
            die("Connection Failed: ". $conn->connect_error);
        } else 
        {
            $sql = "SELECT * FROM info WHERE username = '$username'";
            $exec = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_array($exec))
            {
                echo "<table align='center' cellpadding = '5'>";
                echo "<tr><td><h1>My Information</h1></td>";
                echo "<td><p><a href='logout.php'>Log-out</a></p></td></tr>";
                echo "<tr><td><p><b>Welcome</b> ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</p></td></tr>";
                echo "<tr><td><p><b>Userlevel: </b> ".$row['accesslvl']."</p></td></tr>";
                echo "<tr><td><p><b>Birthday: </b> ".$row['birthday']."</p></td></tr>";
                echo "<tr><td><p><b>Contact Details</b></p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Contact: </b> ".$row['contact']."</p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Email: </b> ".$row['email']."</p></td></tr>";
            }
        }
    ?>
</body>
</html>