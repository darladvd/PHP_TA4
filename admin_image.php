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
                echo "<td><p><a href='admin_adduser.php'>Back</a></p></td></tr>";
                echo "<tr><td><p><b>Welcome</b> ".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</p></td>";
                echo "<td>";
                    if($row['image']!=''){
                        echo "<img src='images/".$data['image']."' height='150' width='150'>";
                    }
                    else{
                        echo "<img src='images/default.png' height='150' width='150'>";
                    }
                echo "<br>Preview</td></tr>";
                echo "<tr><td><p><b>Userlevel: </b> ".$row['accesslvl']."</p></td></tr>";
                echo "<tr><td><p><b>Birthday: </b> ".$row['birthday']."</p></td></tr>";
                echo "<tr><td><p><b>Contact Details</b></p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Contact: </b> ".$row['contact']."</p></td></tr>";
                echo "<tr><td><p><b>&nbsp;&nbsp;Email: </b> ".$row['email']."</p></td></tr>";
                echo "<tr><td><h2>-Upload Image-</h2></td></tr>";
                echo "<tr><td><input type='file' name='image'></td></tr><tr><td><input type = 'submit' name = 'save' value = 'Upload Images'></td></tr></form>";
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
                echo "</table>";
            }
        }
    ?>
</body>
</html>