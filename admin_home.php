<!DOCTYPE html>  
<html>  
<head>

	 <!--  meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Panel</title>  
    <style>
            *{
                font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            }
            form{
                margin:auto;
            }
            .normal{
                margin: auto;
            }
            table, th, td{
                margin-left: auto;
                margin-right: auto;
                padding: 5px;
            }
            table{
                width: 500px;
            }

            div{
                border: 5px solid white;
                background-color: #bcd7ce;
                width: 550px;
                border-radius: 20px;
                padding: 20px;
                margin: auto;
            }
            hr{
                border: 2px solid white;
            }
            .button{
                background-color: #f0d2a2;
                color: black;
                padding: 5px 10px;
                border-radius: 10px;
                cursor: pointer;

            }
            .button:hover{
                background-color: #f5e8db;
            }

            ul{
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            li{
                list-style-type:none;
                float:left;
            }

            li a{
                display: block;
                color:antiquewhite;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active){
                background-color: #DBD3BF;
                color: #968477;
            }

            .active {
                background-color: #97A69A;
                color:antiquewhite
            }

            .a1{
                padding: 3px;
                color:dimgray;
                border-radius: 10px;
            }
            img{
                float:right;
                margin-right: 40px;
            }
        </style>
</head>

<body>
    <body bgcolor="#f5e8db">
    <br><br>

    <div>
    <?php
    session_start();
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

            while($data = mysqli_fetch_array($exec))
            {
                echo "<h1>My Information</h1>";
                echo "<li style='float:right; list-style-type:none;'><a href='logout.php' class='a1' style='color:dimgray; border-radius:10px;'><b><u>Log-out</u></b></a></li><br>";
                echo "<br><br>";
                if($data['image']!=''){
                    echo "<img src='images/".$data['image']."' height='150' width='150'>";
                }
                else{
                    echo "<img src='images/default.png' height='150' width='150'>";
                }
                echo "<b>Welcome </b>".$data['firstname']." ".$data['middlename']." ".$data['lastname']." <br>";
                echo "<b>Userlevel: </b>".$data['accesslvl']."<br>";
                echo "<b>Birthday: </b>".$data['birthday']."<br>";
                echo "<b>Contact Details: </b><br>";
                echo "<b>&nbsp;&nbsp; Contact: </b>".$data['contact']."<br>";
                echo "<b>&nbsp;&nbsp; Email: </b>".$data['email']."<br>";
                echo "<br><br>";

                echo "<br><br><hr><br>";
                echo "<ul><li><a href='admin_image.php' class='a1'><b><u>Upload image</u>&nbsp;&nbsp;</b></a></li>";
                echo "<li><a href='admin_changepass.php' class='a1'><b><u>Reset my password</u></b></a></li><br><br></ul>";
                echo "<br><hr><br>";

                echo "<h2>-Records-</h2>";
                echo "<li><a href='admin_adduser.php' class='a1'><b><u>Add New User</u></b></a></li><br><br></ul>";
                

                $sql2 = "SELECT * FROM info;";
                $exec2 = mysqli_query($conn,$sql2);
                $result = mysqli_num_rows($exec2);
                
                if ($result > 0)
                {
                    echo "<table align='center' cellpadding = '5'>";
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
    </div>
</body>
</html>