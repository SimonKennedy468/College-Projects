<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body style="background-color: black;">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment";
    $run_check = 0;
    $curr_usr = "";
    $data = 0;
    $item_count = 0;

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //check connection
    if($conn->connect_error)
    {
        die("connection failed: " . $conn->connect_error);
    }
        //select currently logged in user
        $sql = "SELECT username from user_login WHERE logged_in = 1";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {   
                //show username and cart info
                $curr_usr = $row["username"];
                echo '<div style = "position: fixed; top: 155px; left: 50px;">';
                echo '<p style="font-size: 300%; color: white;">'.$curr_usr."`s Cart:".'</p>';
                echo '</div>';
            }
        }

        //select all items in cart
        $sql = "SELECT PName FROM cart where username = '$curr_usr'";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                $curr_prod = $row["PName"];
                //check that function runs once, then check each next entry to see if item repeats. If no, it is not printed
                if($run_check == 0)
                {
                    $temp = $row["PName"];
                    $run_check = 1;
                   //count number of times item appears, and show this as item quantity
                    $query = "SELECT COUNT(*) as PName FROM cart WHERE username = '$curr_usr' AND PName = '$curr_prod'";
                    $count_result = $conn->query($query);
                    $data = $count_result -> fetch_assoc();
                    //echo used as php information is being displayed
                    echo '<div style = "position: fixed; top: 275px; left: 180px;">';
                    echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                    echo '</div>';
                    $item_count = $item_count + 1;
                }
                //check if new item has appeared
                if($curr_prod != $temp)
                {
                    $temp = $row["PName"];
                    //count items
                    $query = "SELECT COUNT(*) as PName FROM cart WHERE username = '$curr_usr' AND PName = '$curr_prod'";
                    $count_result = $conn->query($query);
                    $data = $count_result -> fetch_assoc();
                    //depending on how many items are in cart, display item one below the other
                    switch ($item_count)
                    {
                        //echo's are being used rather than exiting PHP as information from PHP is being displayed to the user
                        case 1:
                            echo '<div style = "position: fixed; top: 325px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                        case 2:
                            case 1:
                            echo '<div style = "position: fixed; top: 375px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                        case 3:
                            echo '<div style = "position: fixed; top: 425px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                        case 4:
                            echo '<div style = "position: fixed; top: 475px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                        case 5:
                            echo '<div style = "position: fixed; top: 525px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                        case 6:
                            echo '<div style = "position: fixed; top: 575px; left: 180px;">';
                            echo '<p style="font-size: 200%; color: white;">'.$row["PName"]." X ".$data['PName'];
                            echo '</div>';
                            break;
                    }
                    $item_count = $item_count + 1;
                }
            }
        }


        //select all the current users items
        $sql = "SELECT PName FROM cart where username = '$curr_usr'";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                //calculate the total cost of all items in users cart
                $query = "SELECT sum(total) as totalSum FROM cart WHERE username = '$curr_usr'";
                $sum_result = $conn->query($query);
                $data = $data + $sum_result -> fetch_assoc();
            }
            // display total to user
            //echo used as php information is being displayed
            echo '<div style = "position: fixed; top: 375px; left: 500px;">';
            echo '<p style="font-size: 250%; color: white;">'."Total: ".number_format((float)$data['totalSum'],2, '.','');
            echo '</div>';
        }
        $conn->close();
    
    //check if user wants to checkout
    require_once "assignment_cart.php";
    if(isset($_POST["checkout"]))
    {   
        checkout($curr_usr);
    }

    //checkout function
    function checkout($curr_user)
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

        //delete all items from cart table where items belong to the currently logged in user
        $sql = "DELETE FROM `cart` WHERE username = '$curr_user'";
        if($conn->query($sql) === TRUE)
        {
            echo "success";
        }
        else
        {
            echo "error: " . $sql . "<br>" . $conn->error;
        }
        header("Location: assignment_home.php");
    }
?>
</body>

<div style = "
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 3;
    ">
    <a href ="assignment_home.php"><img src = "assets/topbanner.png"></a>
    </div>

    <div style = "position: fixed; top: 375px; left: 775px; z-index: 2;">
    <form action="assignment_cart.php" method="post" autocomplete="off">
    <input type="submit" name="checkout" value = "" style="height: 80px; width: 238px; background: url('assets/checkout.png')"/> 
    </div>

</div>
</html>