<!----
IMAGES TAKEN FROM:
- https://www.mccabespharmacy.com/health.html
- https://www.band-aid.com/products/variety-packs/adhesive-bandages-family-pack-280-ct-assorted
- https://lloydspharmacy.ie/products/calpol-sixplus
- https://www.amazon.co.uk/Oral-B-CrossAction-Toothbrush-Rechargeable-Including/dp/B00K2U5XFK
- https://www.mccabespharmacy.com/health.html?p=4
- https://www.mccabespharmacy.com/health.html?p=2
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>


</head>
<body style="background-color: black;">
    <?php
    function check_stock($curr_product)
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

        //select relevant stock
        $stock_result = false;
        $sql = "SELECT Stock FROM products WHERE PName = '$curr_product'";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                $curr_stock = $row["Stock"];
            }
        }
        //if item is in stock
        if($curr_stock > 0)
        {
            $stock_result = true;
        }
        //item is out of stock
        else
        {
            $stock_result = false;
        }
        return $stock_result;
        $conn->close();
    }

    function add_item($curr_product)
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
        echo "Connected successfully";

        //select the currently logged in user
        $sql = "SELECT username FROM user_login WHERE logged_in = 1";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0)
        {
            while($row = $result ->fetch_assoc())
            {
                $curr_user = $row["username"];
                echo "curr_user = ".$curr_user;

            }
        }
        //error check if user is logged in
        if($curr_user != "")
        {
            $sql = "SELECT PName, Stock, price FROM products WHERE PName = '$curr_product'";
            $result = $conn->query($sql);
            if ($result -> num_rows > 0)
            {
                while($row = $result ->fetch_assoc())
                {
                    $curr_product = $row["PName"];
                    $curr_price = $row["price"];
                    $curr_stock = $row["Stock"];
                    echo "curr_product = ".$curr_product;

                }
            }
            $curr_stock = $curr_stock - 1;
            echo $curr_stock;
            //ensure item is still in stock
            if($curr_stock > -1)
            {   //remove 1 stock from products table
                $sql = "UPDATE products SET Stock = '$curr_stock' WHERE PName = '$curr_product'";
                if($conn->query($sql) === TRUE)
                {
                    echo "updated products table";
                }
                else
                {
                    echo "error: " . $sql . "<br>" . $conn->error;
                }
                //insert information into cart 
                $sql = "INSERT INTO cart VALUES('$curr_user','$curr_product','$curr_price')";
                if($conn->query($sql) === TRUE)
                {   
                    echo "success";
                }
                else
                {
                    echo "error: " . $sql . "<br>" . $conn->error;
                }
            }
            else
            {
                echo "out of stock";
            }
            //refresh page to prevent double input on refresh
            header("Location: assignment_products.php");
        }
        else
        {   
            //refresh page to prevent double input on refresh
            header("Location: assignment_login.php");
        }
        $conn->close();
    }

    //check what button is pressed
    if(isset($_POST['eyedrops']))
    {
        add_item('Eye Drops');
    }
    if(isset($_POST['bandaids']))
    {
        add_item('Band-aids');
    }
    if(isset($_POST['calpol']))
    {
        add_item('Calpol');
    }
    if(isset($_POST['toothbrush']))
    {
        add_item('Electric Toothbrush');
    }
    if(isset($_POST['mouthwash']))
    {
        add_item('Mouthwash');
    }
    if(isset($_POST['lipbalm']))
    {
        add_item('Lipbalm');
    }
    
?>

<div style="
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: -1;
    ">
    <a href="assignment_home.php"><img src="assets/topbanner.png"></a>
</div>

<div style="
    position: fixed;
    top: 50px;
    left: 700px;
    z-index: -1;
    ">
    <a href="assignment_cart.php"><img src="assets/cart.png"></a>
</div>

<div style="
    position: fixed;
    top: 141px;
    left: 0px;
    z-index: -1;
">
<img src="assets/product_page.png">
</div>

<div style="
    position: fixed;
    top: 400px;
    left: 30px;
    z-index: -1;
    ">
<form action="assignment_products.php" method="post" autocomplete="off">
<label for="eyedrops" style = "color: white;">Eye Drops:‏‏‎ </label>
<?php 
    if(check_stock('Eye Drops') === true)
    {?>
        <input type="submit" name="eyedrops" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>

<div style="
    position: fixed;
    top: 400px;
    left: 430px;
    z-index: -1;
    ">
<label for="bandaids" style = "color: white;">Band-Aids:‏‏‎ </label>
<?php 
    if(check_stock('Band-aids') === true)
    {?>
        <input type="submit" name="bandaids" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>

<div style="
    position: fixed;
    top: 400px;
    left: 775px;
    z-index: -1;
    ">
<label for="calpol" style = "color: white;">Calpol:‏‏‎ </label>
<?php 
    if(check_stock('Calpol') === true)
    {?>
        <input type="submit" name="calpol" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>

<div style="
    position: fixed;
    top: 840px;
    left: 50px;
    z-index: -1;
    ">
<label for="toothbrush" style = "color: white;">Electric Toothbrush:‏‏‎ </label>
<?php 
    if(check_stock('Electric Toothbrush') === true)
    {?>
        <input type="submit" name="toothbrush" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>

<div style="
    position: fixed;
    top: 840px;
    left: 430px;
    z-index: -1;
    ">
<label for="mouthwash" style = "color: white;">Mouthwash:‏‏‎ </label>
<?php 
    if(check_stock('Mouthwash') === true)
    {?>
        <input type="submit" name="mouthwash" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>

<div style="
    position: fixed;
    top: 840px;
    left: 800px;
    z-index: -1;
    ">
<label for="lipbalm" style = "color: white;">Lip Balm:‏‏‎ </label>
<?php 
    if(check_stock('Lipbalm') === true)
    {?>
        <input type="submit" name="lipbalm" value="Add to cart"/>
        <?php
    }
    else
    {?>
        <p style ="color: white;">Out of stock</p>
        <?php
    }?>

</div>
</body>
</html>