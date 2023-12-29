<?php session_start();?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="author" content="Melissa Pelham"/>
    <meta name="description" content="Shopping Cart"/>
    <link rel="stylesheet" href="Style/style.css">
    <script src="Scripts/script1.js" defer></script>
    <title>Shopping Cart</title>
    
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>

  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div class = "Area-1 Area-center">
          <h1>Shopping Cart</h1>

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
                  echo "<span class=\"minus\" onClick=\"decreaseCount(event, this)\">-</span>";
                  echo "<input type=\"amount\" value=\"". $row['quantity'] . "\">";
                  echo "<span class=\"plus\" onClick=\"increaseCount(event, this)\">+</span>";
                echo "</div>";
              echo "</div>";
            echo "</li>";
            echo "<hr>";

            } 
            mysqli_free_result($result);
        }
    } 
    
  
    ?>

            <li>
              <div class="order_sum">
              <ul>
                <?php require_once "cart-total.php"?>
                <li>
                  <div class="order_total">
                  <p>Total Amount</p>
                  <h3>$<?php echo $total?></h3></li>
                  </div>
                </li>
                <?php
                $error = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                  if(!isset($_SESSION['user_id'])){
                    $error .= "<p>Please Sign In First</p>";
                  }else{
                    header("location: Shipping.php");
                  }
                }
                ?>
                <form action="" method="POST">
                  <ul>
                  <li><input type="submit" Name= "submit" value="Next"></li>
                  </ul>
                  <?php 
                  echo $error; ?>
                </form>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </body>
</html>

  