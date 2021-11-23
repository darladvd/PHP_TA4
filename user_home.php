<!DOCTYPE html>
<html>
    <head>
        <title>User Account</title>
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
                width: 400px;
            }

            div{
                border: 5px solid white;
                background-color: #bcd7ce;
                width: 500px;
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
    <body bgcolor="#f5e8db">

    <br><br>

        <div>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'ta4');
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ".$conn->connect_error);
        }
        session_start();
        
        if(!isset($_SESSION['username'])){
            header('location: login.php');
        }
        $username = $_SESSION['username'];
        $record = mysqli_query($conn, "select * from info where username = '$username'");
        
        
        echo "<h2>My Information</h2>";
        ?>
        
        <li style='float:right; list-style-type:none;'><a href='logout.php' class='a1' style='color:dimgray; border-radius:10px;'><b><u>Log-out</u></b></a></li>
        <br>

        

        <?php
        
        echo "<br><br>";
        while($data = mysqli_fetch_array($record)){
            if($data['image']!=''){
                echo "<img src='images/".$data['image']."' height='150' width='150'>";
            }
            else{
                echo "<img src='images/default.png' height='150' width='150'>";
            }

            echo "<b>Welcome </b>".$data['firstname']." ".$data['middlename']." ".$data['lastname']." <br>";
            echo "<b>User Level: </b>".$data['accesslvl']."<br>";
            echo "<b>Birthday: </b>".$data['birthday']."<br>";
            echo "<b>Contact Details: </b><br>";
            echo "<b>&nbsp;&nbsp; Contact: </b>".$data['contact']."<br>";
            echo "<b>&nbsp;&nbsp; Email: </b>".$data['email']."<br>";
        }

        echo "<br><br>";
        ?>

        <br><br><hr><br>
        <ul>
            <li><a href='user_image.php' class='a1'><b><u>Upload image</u>&nbsp;&nbsp;</b></a></li>
            <li><a href='user_changepass.php' class='a1'><b><u>Reset my password</u></b></a></li><br><br>
        </ul>
        <br><hr><br>
        </div>
    </body>
</html>