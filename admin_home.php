<!DOCTYPE html>  
<html>  
<head>

	 <!--  meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Home</title>  
    <style> 
    h1, p
    {
        font-family: Montserrat, sans-serif;
        text-align: left;
    }

    table
    {
        font-family: Montserrat, sans-serif;      
        height: 800px;
        width: 1000px;
        border: 5px solid #1F4172;
        border-radius: 4px;
    }
    </style>  
</head>

<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"" enctype="multipart/form-data">
    <?php
        session_start();
        error_reporting(0);

        if (!isset($_SESSION['username']) || !isset($_SESSION['password']))
        {
			header("Location: login.php");
		}
		elseif ($_SESSION['userlevel'] == "user")
        {
			header("Location: user_home.php");
		}

        $firsname = $_SESSION['firsname'];
        $middlename = $_SESSION['middlename'];
        $lastname = $_SESSION['lastname'];
        $contact = $_SESSION['contact'];
        $email - $_SESSION['email'];
        $birthday = $_SESSION['birthday'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $accesslvl - $_SESSION['accesslvl'];
        $status = $_SESSION['status'];

        $conn = mysqli_connect('localhost','root','','ta4');

        if($conn->connect_error)
        {
            echo "$conn->connect_error";
            die("Connection Failed: ". $conn->connect_error);
        } else 
        {
            $sql = "SELECT * FROM info WHERE username = '$username' AND password = '$password'";
            $exec = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_array($exec))
            {
                echo "<table align='center' cellpadding = '10'>";
                echo "<th><h1>Admin Account</h1></th>";
                echo "<tr><td><p><a href='login.php'>Log-out</a></p></td><td><p><a href='info-viewusers.php'>View Records</a></p></td><td><p><a href='info-admin_app.php'>Add Record</a></p></td></tr>";
                echo "<tr><td><p><b>Welcome</b><br>".$row['username']."(".$row['userlevel'].")<br></p></td>";
                echo "<td><img src=images/".$row['image']."></td></tr>";
                echo "<tr><td><p><b>Userlevel:</b><br>".$row['userlevel']."<br></p></td>";
                echo "<td><input type='file' name='image'></td><td><input type = 'submit' name = 'save' value = 'save changes'></td></form>";
                    if (isset($_POST['save']) && isset($_FILES['image']))
                    {
                        $imgName = $_FILES['image']['name'];
                        $imgSize = $_FILES['image']['size'];
                        $tmpName = $_FILES['image']['tmp_name'];
                        $error = $_FILES['image']['error'];

                        if ($error === 0){
                            if ($imgSize > 5000000)
                            {
                                echo "Sorry, your file size is too large.";
                            } else
                            {
                                $imgEx = pathinfo($imgName, PATHINFO_EXTENSION);
                                $imgExLc = strtolower($imgEx);
                                
                                $allowed_exs = array("jpg", "jpeg", "png");
                                
                                if (in_array($imgExLc, $allowed_exs))
                                {
                                    $new_imgName = uniqid("IMG-", true).'.'.$imgExLc;
                                    $img_upload_path = 'images/'.$new_imgName;
                                    move_uploaded_file($tmpName, $img_upload_path);
                                    
                                    $exec2 = "UPDATE info SET image = '" . $new_imgName . "' WHERE username = '".$username."'"; 
                                    mysqli_query($conn, $exec2);
                                }
                            }
                        }
                        else
                        {
                            echo "Error.";
                        }
                    }
                echo "</td></tr>";
                echo "<tr><td><p><b>Email:</b><br>".$row['email']."<br><hr></p></td></tr>";
                echo "<th><h2>Reset Password</h2></th>";
                echo "<tr><td><p><b>Enter Current Password: <input type='password' name='cpassword'><br></b></p></td></tr>";
                echo "<tr><td><p><b>Enter New Password: <input type='password' name='npassword'><br></b></p></td></tr>";
                echo "<tr><td><p><b>Re-Enter New Password: <input type='password' name='n2password'><br></b></p></td></tr>";
                echo "<tr><td><p><input type='submit'></td></tr>";
                echo "</table>"; 
            }
        }
    ?>
    </form>
</body>
</html>