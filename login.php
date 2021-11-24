<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
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
                padding: 10px 20px;
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
                margin-right: 60px;
            }
        </style>
    </head>
    <body bgcolor="#f5e8db">
    <br><br>

        <?php 
        $conn = mysqli_connect('localhost', 'root', '', 'ta4');
        if($conn->connect_error){
            echo "$conn->connect_error";
            die("Connection Failed : ".$conn->connect_error);
        }

        session_start();
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['username'])){
            $level = mysqli_query($conn, "select accesslvl as lvl from info where username='".$_SESSION['username']."'");
                while($record = mysqli_fetch_array($level)){
                    if($record['lvl'] == "admin"){
                        header("location: admin_home.php");
                    }
                    else{
                        header("location: user_home.php");
                    }
                }
            exit;
        }
        ?>

        <div>
        <h2 style="text-align: center;">Log-in Form</h2>
        <table>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <tr><td>Username: </td><td><input type="text" name="username" required placeholder="Enter username"></td></tr>

                <tr><td>Password: </td><td><input type="password" name="password" required placeholder="Enter password"></td></tr>

                <tr><td><input type="submit" name="submit" value="Submit" class="button"></td><tr>
            </form>
        </table>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $password = $_POST['password'];

            echo "<hr>";
            
            $p_un = mysqli_real_escape_string($conn, $username);
            $p_pw = mysqli_real_escape_string($conn, $password);
            $sql = mysqli_query($conn, "select count(*) as usercnt from info where username='".$p_un."' and password='".$p_pw."'");
            $data = mysqli_fetch_array($sql);

            $count = $data['usercnt'];
            if($count > 0){
                $accstat = mysqli_query($conn, "select status as stat from info where username='".$p_un."'");
                while($stat = mysqli_fetch_array($accstat)){
                    if($stat['stat'] == "active"){
                        $_SESSION['username'] = $p_un;
                        $_SESSION['loggedin'] = true;
        
                        $level = mysqli_query($conn, "select accesslvl as lvl from info where username='".$p_un."'");
                        while($record = mysqli_fetch_array($level)){
                            if($record['lvl'] == "admin"){
                                header("location: admin_home.php");
                            }
                            else{
                                header("location: user_home.php");
                            }
                        }
                    }
                    else{
                        echo "This account is disabled, please contact the administrator...";
                    }
                }
                
            }
            else{
                echo "Invalid username and/or password. Please try again...";
            }
            mysqli_close($conn);
        }
        ?>
        </div>
    </body>
</html>