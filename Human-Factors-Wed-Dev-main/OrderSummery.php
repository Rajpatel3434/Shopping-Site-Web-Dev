
<?php session_start();
?>


<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="author" content="Melissa Pelham"/>
    <meta name="description" content="Order Summary"/>
    <link rel="stylesheet" href="Style/style.css">
    <title>Order Summary</title>
    
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>

  <body id="grad">
    <?php require_once "PHP/menu.php"; 
    ?> 
    
    <div class = "Area-1 Area-center">
      <h1>Order Summary</h1>
        
          <?php
          $session_id =session_id();
        $sql = "SELECT products.productName, products.productDesc, products.images, products.price, cart.quantity
        FROM products
        JOIN cart ON cart.product_id = products.product_id
        WHERE cart.session_id = '$session_id';";
    
    if ($result = mysqli_query($conn, $sql)){
        if (mysqli_num_rows($result)>=1){
          
          echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)){
              echo "<li>";
              echo "<div class=\"product\">";
              echo "<img class=\"product-image\" src=\"".$row["images"]."\">";
              echo "<ul>";
                echo "<li><h2>".$row["productName"]."</h2></li>";
                echo "<li><p>".$row["productDesc"]."</p></li>";
               echo "</ul>";
                echo "<div class=\"product_amount_info\">";
                  echo "<h2>$".$row["price"]."</h2>";
                echo "</div>";
              echo "</div>";
            echo "</li>";
            echo "<hr>";

            } 
            mysqli_free_result($result);
        }
    } 
  
    ?>
            <?php require_once "cart-total.php";?>
            <div class="order_sum" class="order_total">
            <li><p>Total Amount</p>
            <h3>$<?php echo $total?></h3></li>
            <form action="final-payment-prosses.php" method="get">
              <li><input type="submit" value="Confirm"></li>
            </form>
          </ul>
          </li>
        </div>
      </ul>
    </div>
  </body>
</html>