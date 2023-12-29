<?php session_start();?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="author" content="Melissa Pelham"/>
    <meta name="description" content="Shipping"/>
    <link rel="stylesheet" href="Style/style.css">
    <title>Shipping</title>
    
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>

  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div class = "Area-1 Area-center cart-sum">
      <div>
      <form method="POST" action="Add-address.php">
              <h1>Shipping Address</h1>
              <ul>
              <li>Full Name <br> <input type="text" id="fullname" name="Full Name" placeholder="Required" required></li>
              <li>Email <br> <input type="email" id="email" name="Email" placeholder="Required" required></li>
              <li>Address <br> <input type="text" id="address" name="address" placeholder="Required" required></li>
              <li>City <br> <input type="text" id="city" name="city" placeholder="Required" required></li>
              <li>Country <br> <input type="text" id="country" name="country" placeholder="Required" required></li>
              <li>Postcode <br> <input type="text" id="postcode" name="postcode" placeholder="Required" required></li>
              <li><input type="submit" value="Next"></li>
              </ul>
          </form>
      </div>
      <hr>
      <div>
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
            
            <?php require_once "cart-total.php"?>
            <div class="order_sum" class="order_total">
            <li><p>Total Amount</p>
            <h3>$<?php echo $total?></h3></li>
          </ul>
          </li>
        </div>
      </ul>
      </div>
    </div>
  </body>
</html>