<?php
  session_start();
?>
<html>
    <head>
        <title>Product Page</title>
        <meta charset="UTF-8" />
        <meta name="Raj" content="productpage" />
        <link rel="stylesheet" href="style/style.css">
        <script src="Scripts/script1.js" defer></script>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    </head>
    <body id="grad">
        <?php require_once "PHP/menu.php"; ?>
        <div class="Area-1 Area-center">




         <?php  

                    $sql = "SELECT productName, productDesc, images, price, product_id
                    FROM products
                    where product_id=$_GET[id]
                    ;";
                    if ($result = mysqli_query($conn, $sql)){
                        
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<img src=\"" .$row["images"]. "\" href=\"Images\">";
                                echo "<h3> ". $row["productName"] . "</h3>";
                                echo "<h3> $". $row["price"] . "</h3>";

                             
                                echo "<h3>" .$row["productDesc"] . "</h3>";


                                echo "<form action=\"add-to-cart.php\" method=\"GET\">";
                                echo "<span class=\"minus\" onClick=\"decreaseCount(event, this)\">-</span>";
                                echo "<input type=\"amount\" NAME='quantity' value=\"1\">
                                <span class=\"plus\" onClick=\"increaseCount(event, this)\">+</span>";
                                echo "<INPUT TYPE=HIDDEN NAME='prodId' value='". $row['product_id']."'/>";
                                echo "<input type=\"submit\" name = \"add-cart\" value=\"Add to Cart\"></input>";
                                echo "</form>";

                                        
                            }mysqli_free_result($result);
                            
                        }
                    } 
                    mysqli_close($conn);
            ?> 





            
    </body>
</html>