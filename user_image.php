<!DOCTYPE html>
<html>
    <head>
        <title>Upload Image</title>
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
                background-color: #eabc81;
                border-radius: 10px;
            }

            li{
                float: left;
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
        
        <li style='float:right; list-style-type:none;'><a href='user_home.php' class='a1' style='color:dimgray; border-radius:10px;'><b><u>Back</u></b></a></li><br><br>
        <br>

        

        <?php
        while($data = mysqli_fetch_array($record)){
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
        }

        echo "<br>";
        ?>
        <br><br><hr>
        <h3>Upload Image</h3>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        <input type="file" name="pic" id="pic" style="margin-left:150px;"><br><br>
        <button type="submit" name="upload" class="button" style="margin-left:180px;">Upload Image</button>
        <br>
        <?php
        if (isset($_POST['upload'])) {

            $image = $_FILES['pic']['name'];
            // image file directory
            $target = "images/".basename($image);

            $setpic = $conn->query("UPDATE info SET image='".$image."' WHERE username = '".$username."'");
            // execute query

            if (move_uploaded_file($_FILES['pic']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }
        }

        ?>

        </form>
        <br><br><hr>
        
        </div>
    </body>
</html>