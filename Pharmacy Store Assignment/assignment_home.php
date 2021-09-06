<!---
IMAGES TAKEN FROM:
- https://www.financialexpress.com/lifestyle/health/covid-19-who-says-asymptomatic-spread-of-coronavirus-rare-then-clarifies/1986996/
- https://www.contactcenterworld.com/company/blog/conversational/?id=7419dfa9-2e23-46c2-86cc-fe71500233e5
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body style="background-color: black;">
<?php
    $show_login = true;
    //function to log user out on input
    function log_out()
    {
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

        //set all login variable to 0, and log user out
        $sql = "UPDATE user_login SET logged_in = 0";
        if($conn->query($sql) === TRUE)
            {
                echo "should be reset";
                header("Location: assignment_home.php");
            }
        
        $conn->close();
    }
    //check if user is logged in
    function check_logged_in()
    {  
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
    
        //select all users from table where logged_in is 1. Should only apply to 1 user at a time
        $sql = "SELECT username from user_login WHERE logged_in = 1";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                echo "Welcome, ".$row["username"];
                //user is logged in
                $show_login = false;
            }
        }

        else
        {
            //no user logged in
            $show_login = true;
        }
        $conn->close();
        return $show_login;
    }
    //check logout button clicked
    if(isset($_POST['logout']))
    {
        log_out();
    }
?>
    <div style = "
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 3;
    ">
    <a href ="assignment_home.php"><img src = "assets/topbanner.png"></a>
    </div>
    <div
    <?php
        if(check_logged_in() === false)
        {
            ?>
            style="display:none"
            <?php
        }
        else
        {
            ?>
            style="position: fixed;
                   top: 0px;
                   left: 600px;
                   z-index: 2;"
            <?php
        }
    ?>
    >
    <a href ="assignment_login.php"><img src="assets/login_button.png"></a>
    </div>
    <div style = "
    position: fixed;
    top: 133px;
    left: -8px;">
    <a href ="assignment_products.php"><img src="assets/browse.png"></a>
    </div>
    <div style = "
    position: fixed;
    top: 63px;
    left: 600px;
    z-index: 2;">
    <a href = "assignment_cart.php"><img src="assets/cart.png"></a>
    </div>
    <div 
    <?php
        if(check_logged_in() === true)
        {
            ?>
            style="display:none"
            <?php
        }
        else
        {
            ?>
            style = "
            position: fixed;
            top: -2px;
            left: 600px;
            z-index: 2"
            <?php
        }
    ?>
    >
    <form action="assignment_home.php" method="post" autocomplete="off">
    <input type="submit" name="logout" value=""style="height: 71px; width: 151px; background: url('assets/logout_button.png')"/>
    </div>
    <div style = "
    position: fixed;
    top: 200px;
    left: -8px;">
    <img src="assets/homepage_text.png"></a>
    </div>

    
</body>
</html>