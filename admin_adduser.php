<!DOCTYPE html>  
<html>  
<head>

	 <!--  meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add Record</title>  
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
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <?php
        session_start();
        echo "<table align='center' cellpadding = '10'>";
        echo "<td><h1>Add User</h1></td><td><li style='float:right; list-style-type:none;'><a href='admin_home.php' class='a1' style='color:dimgray; border-radius:10px;'><b><u>Back</u></b></a></li><br><td>";
        echo "<tr><td><b>Fill Up Form</b></td></tr>";
        echo "<tr><td><p><b>First Name: <input type='text' name='firstname' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Middle Name: <input type='text' name='middlename' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Last Name: <input type='text' name='lastname' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Username: <input type='text' name='username' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Password: <input type='password' name='password' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Confirm Password: <input type='password' name='cpassword' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Birthday: <input type='date' name='birthday' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Email: <input type='email' name='email' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Contact Number: <input type='number' name='contact' required><br></b></p></td></tr>";
        echo "<tr><td><p><b>Access Level: </b><input type='radio' name='accesslvl' id='admin' value='admin'><label for='admin'>admin</label><input type='radio' name='accesslvl' id='user' value='user'><label for='user'>user</label><br></p></td></tr>";
        echo "<tr><td><p><b>Status: </b><input type='radio' name='status' id='active' value='active'><label for='active'>active</label><input type='radio' name='status' id='disable' value='disable'><label for='disable'>disable</label><br></p></td></tr>";
        echo "<tr><td><input type='submit' name='submit' value='Submit' class='button'></td><tr>";
        echo "</table>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $birthday = $_POST['birthday'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $accesslvl = $_POST['accesslvl'];
            $status = $_POST['status'];

            $conn = mysqli_connect('localhost','root','','ta4');

            if($conn->connect_error)
            {
                echo "$conn->connect_error";
                die("Connection Failed: ". $conn->connect_error);
            } else
            {
                if (strcmp($password, $cpassword) == 0)
                {
                    $sql = "INSERT INTO info (firstname, lastname, middlename, username, password, birthday, email, contact, accesslvl, status) 
                    VALUES ('$firstname','$lastname','$middlename','$username','$password', '$birthday', '$email', '$contact', '$accesslvl', '$status')";
    
                    $exec = mysqli_query($conn, $sql);
                    if ($exec)
                    {
                        echo "<script>alert('Added Successfully!')</script>"; 
                    } else
                    {
                        echo "<script>alert('Not Added.')</script>"; 
                    }
                } else
                {
                    echo "<script>alert('Password Does Not Match.')</script>"; 
                }
            }
        }
    ?>
    </div>
</body>
</html>