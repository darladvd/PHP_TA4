<!DOCTYPE html>  
<html>  
<head>

	 <!--  meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add Record</title>  
    <style> 
    h1, p
    {
        font-family: Montserrat, sans-serif;
        text-align: left;
    }

    table
    {
        font-family: Montserrat, sans-serif;      
        height: 200px;
        width: 500px;
        border: 5px solid #1F4172;
        border-radius: 4px;
    }

    button
    {
        margin-left: 130px;
        width: 200px;
    }
    </style>  
</head>

<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <?php
        session_start();
        echo "<table align='center' cellpadding = '10'>";
        echo "<td><h1>Add User</h1></td>";
        echo "<td><p><a href='admin_home.php'>Back</a></p></td>";
        echo "<tr><td><b>Fill Up Form</b></td></tr>";
        echo "<tr><td><p><b>First Name: <input type='text' name='firstname'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Middle Name: <input type='text' name='middlename'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Last Name: <input type='text' name='lastname'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Username: <input type='text' name='username'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Password: <input type='password' name='password'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Confirm Password: <input type='password' name='cpassword'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Birthday: <input type='date' name='birthday'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Email: <input type='email' name='email'><br></b></p></td></tr>";
        echo "<tr><td><p><b>Contact Number: <input type='number' name='contact'><br></b></p></td></tr>";
        echo "<tr><td><p><button type='submit'>Submit</button></td></tr>";
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

            $conn = mysqli_connect('localhost','root','','ta4');

            if (empty($firstname))
            {
                error_reporting(0);
            }

            if($conn->connect_error)
            {
                echo "$conn->connect_error";
                die("Connection Failed: ". $conn->connect_error);
            } else 
            {
                $sql = "INSERT INTO info (firstname, lastname, middlename, username, password, cpassword, birthday, email, contact) 
                VALUES ('$firstname','$lastname','$middlename','$username','$password','$cpassword', '$birthday', '$email', '$contact')";

                $exec = mysqli_query($conn, $sql);
                if ($exec)
                {
                    echo "<script>alert('Added Successfully!')</script>"; 
                } else
                {
                    echo "<script>alert('Error. Please try again!')</script>"; 
                }
            }   
        }
    ?>
</body>
</html>