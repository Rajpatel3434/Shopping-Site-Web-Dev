<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Order History</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Bradley Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div class="cart-sum">
      <?php require_once "PHP/account menu.php"; ?>
      
      <div class="Area-2 profile-area">
        <h1>Order History</h1>
        <div>

          
          <?php 
            $sql1 = "SELECT order_details.order_id, payment_details.amount
            FROM order_details
            JOIN payment_details ON payment_details.payment_id = order_details.payment_id
            WHERE user_id = $_SESSION[user_id];";

            if ($result = mysqli_query($conn, $sql1)){
                if(mysqli_num_rows($result) > 0) {
                  $count = 1;                    
                    while ($row = mysqli_fetch_assoc($result)){
                      $sql2 ="SELECT order_details.order_id , order_items.product_id, products.productName, products.images, products.productDesc, order_items.quantity, products.price
            FROM order_details
            JOIN order_items ON order_details.order_id = order_items.order_id 
            JOIN payment_details ON order_details.payment_id = payment_details.payment_id 
            JOIN products ON order_items.product_id = products.product_id
            WHERE order_details.order_id = $row[order_id];";?>
                    
                      <h1>Order <?php echo $count;
                      $count++;?></h1>
                        <hr>
                        <?php
                      if ($result2 = mysqli_query($conn, $sql2)){
                        if(mysqli_num_rows($result2) > 0) {
                          while ($row2 = mysqli_fetch_assoc($result2)){
                            ?>
                            <div class="product">
                              <img class="product-image" src="<?php echo $row2["images"];?>">
                              <ul>
                                <li><h2><?php echo $row2["productName"];?></h2></li>
                                <li><p><?php echo $row2["productDesc"];?></p></li>
                              </ul>
                              <div class="product_amount_info">
                                <h2>$<?php echo $row2["price"];?></h2>
                              </div>
                            </div>
                              <hr>
          <?php
                      }
                    }
                  }
                echo "<h3>Total $" . $row["amount"] . "</h3><hr>";
                }mysqli_free_result($result2);
              }else{
                echo "<h1>No Previous Orders</h1>";
              }
            } 
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
          <!-- change here -->
          
          <!-- to here  -->
        </div>
      </div>
    </div>
  </body>
</html>
