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
        height: 500px;
        width: 500px;
        border: 5px solid #1F4172;
        border-radius: 4px;
    }

    img
    {
        height: 100px;
        width: 100px;
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
                echo "<tr><td><p><b>Welcome</b> ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</p></td>";
                echo "<td>";
                    if($row['image']!=''){
                        echo "<img src='images/".$data['image']."' height='150' width='150'>";
                    }
                    else{
                        echo "<img src='images/default.png' height='150' width='150'>";
                    }
                echo "</td></tr>";
                echo "<tr><td><p><b>Userlevel: </b> ".$row['accesslvl']."</p></td></tr>";
                echo "<tr><td><p><b>Birthday: </b> ".$row['birthday']."</p></td></tr>";
                echo "<tr><td><p><b>Contact Details</b></p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Contact: </b> ".$row['contact']."</p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Email: </b> ".$row['email']."</p></td></tr>";
                echo "<tr><td><p>&nbsp;&nbsp;<a href='admin_image.php'>upload image</a></p></td><td><p><a href='admin_changepass.php'>reset my password</a></p></td></tr>";
                echo "<tr><td><h2>-Records-</h2></td></tr>";
                echo "<tr><td><p><a href='admin_adduser.php'>Add New User</a></p></td></tr>";

                $sql2 = "SELECT * FROM info;";
                $exec2 = mysqli_query($conn,$sql2);
                $result = mysqli_num_rows($exec2);
                
                if ($result > 0)
                {
                    echo "<tr><td>ID</td><td>Email</td><td>Username</td><td>Password</td><td>Userlevel</td><td>Status</td></tr>";
                    while ($row = mysqli_fetch_assoc($exec2))
                    {
                        echo "
                        <tr><td>". $row['ID'] ."</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['password'] . "</td>
                        <td>" . $row['accesslvl'] . "</td>
                        <td>" . $row['status'] . "</td></tr>";
                    }
                }
                echo "</table>";
            }
        }
    ?>
</body>
</html>