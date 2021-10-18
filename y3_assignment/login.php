<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
    function login()
    {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "y3_assignment";


        //create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //check connection
        if($conn->connect_error)
        {
            die("connection failed: " . $conn->connect_error);
        }

        //creat vars for checking login matches
        $username_result = "";
        $password_result = "";
        $user_name = $_POST["user_name"];
        $pass_word = $_POST["Pass_word"];

        //check if username is in database
        $sql = "SELECT username, password FROM user_login WHERE username = '$user_name'";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                //get results from search
                $username_result = $row["username"];
                $password_result = $row["password"];
            }
        }
        else
        {
            echo "fail";
        }
        //check if input is empty
        if($pass_word == "")
        {
            echo "fail";
            //show login fail message
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/login_fail.png">
            </div>
            <?php
        }
        //check if input is empty
        else if($user_name == "")
        {
            echo "fail";
            //show login fail message
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/login_fail.png">
            </div>
            <?php
        }
        //check for match
        else if(($username_result == $user_name) && ($password_result == $pass_word))
        {
            $sql = "UPDATE user_login SET logged_in = 1 WHERE username = '$user_name'";
            if($conn->query($sql) === TRUE)
            {
                //if login sucessful, redirect to homepage
                header("Location: assignment_home.php");
            }
        }
        //no match
        else
        {
            echo "fail";
            //show login fail message
            ?>
            <div 
                    style = "position: fixed;
                    top: 450px;
                    left: 250px;
                    z-index: 2;"
                     >
            <img src="assets/login_fail.png">
            </div>
            <?php
        }
        $conn->close();

    }
    //check if login button is pressed
    require_once "login.php";
    if(isset($_POST["user_name"]) && isset($_POST["Pass_word"]) && isset($_POST["login"]))
    {   
        login();
    }
    

?>


<div style = "
position: absolute;
top: 45%;
left: 40%;
z-index: 2;">
    <form action="assignment_login.php" method="post" autocomplete="off">
    <label for="user_name">Username:‏‏‎ </label>
    <input type="text" name="user_name">
    <br>
    <label for="Pass_word" >Password:‏‏‎‏‏‎ ‎</label>
    <input type="password" name="Pass_word"/>
    <div style = "position: absolute; top: -5%; left: 105%; z-index: 2;">
    <input type="submit" name="login" value = "" style="height: 50px; width: 100px; background: url('assets/loginbutton2.png')"/> 
    </div>
    <br>
    <a href = "signup.php">No account? Signup Here!</a>
</div>

</body>
</html>