<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body style="background-color: black;">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment";


    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //check connection
    if($conn->connect_error)
    {
        die("connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    require_once "assignment_signup.php";
    //check that textboxes are filled
    if(isset($_POST["user_name"]) && isset($_POST["Pass_word"]) && isset($_POST["Pass_word_Confirm"]))
    {
        $user_name = $_POST["user_name"];
        $pass_word = $_POST["Pass_word"];
        $pass_word_confirm = $_POST["Pass_word_Confirm"];
        $name_taken = false;
        echo "var created";

        //check if username is taken
        $sql = "SELECT username FROM user_login WHERE username = '$user_name'";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                $name_taken = true;
            }
        }

        //check that passwords match and username is not already in database
        if($pass_word == $pass_word_confirm && $name_taken == false)
        {
            $sql = "UPDATE user_login SET logged_in = 0";
            $sql = "INSERT INTO user_login VALUES ('$user_name','$pass_word', 1)";
            if($conn->query($sql) === TRUE)
            {
                //if successful redirect to homepage
                echo "success";
                header("Location: assignment_home.php");
            }
            else
            {
                echo "error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        //check if username or password or password check space is blank
        else if($user_name == "" || $pass_word == "" || $pass_word_confirm = "")
        {
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/blank_signup.png">
            </div>
            <?php
        }
        
        //if username is taken
        else if ($name_taken == true)
        {
            //show name taken error message
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/username_no_match.png">
            </div>
            <?php
        }
        else
        {
            //show no password match
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/passwords_no_match.png">
            </div>
            <?php
        }
    }
    else
    {
        echo "some issue";
    }
?>
<div style = "
position: fixed;
top: 50px;
left: 200px;
z-index: 2
">
<a href="assignment_home.php"><img src="assets/topbanner.png"></a>
</div>

<div style = "
position: fixed;
top: 0px;
left: 0px;
z-index: 1
">
<img src="assets/loginbackground.png">
</div>


<div style = "
position: fixed;
top: 350px;
left: 350px;
z-index: 2;">
<form action="assignment_signup.php" method="post" autocomplete="off">
<label for="user_name" style = "color: white;">Username:‏‏‎‏‏‎ ‏‏‎ ‎‏‏‎ ‎‏‏‎‏‏‎ ‎‏‏ ‏ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎‎‏‏‎ ‎ ‎‏‏‎ ‎ ‎‎‏ ‎</label>
<input type="text" name="user_name">
<br>
<label for="user_name" style = "color: white;">Password:‏‏‎ ‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎‏‏‎ ‎</label>
<input type="password" name="Pass_word"/>
|<br>
<label for="user_name" style = "color: white;">Confirm Password:‏‏‎ </label>
<input type="password" name="Pass_word_Confirm"/>
<br>
<div style = "position: fixed; top: 348px; left: 660px; z-index: 2;">
    <input type="submit" name="login" value = "" style="height: 72px; width: 186px; background: url('assets/signup_button.png')"/> 
    </div>

</div>

</body>
</html>
</body>
</html>