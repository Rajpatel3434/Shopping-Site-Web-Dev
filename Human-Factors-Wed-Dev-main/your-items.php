<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Your Marketplace Products</title>
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
        <h1>Your Marketplace Products</h1>
        <div>

          
          <?php 
            
            $sql ="SELECT productName, productDesc, price, images
            FROM products
            WHERE user_id = $_SESSION[user_id];
            ";
                    
                        
              if ($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="product">
                      <img class="product-image" src="<?php echo $row["images"];?>">
                      <ul>
                        <li><h2><?php echo $row["productName"];?></h2></li>
                        <li><p><?php echo $row["productDesc"];?></p></li>
                      </ul>
                      <div class="product_amount_info">
                        <h2>$<?php echo $row["price"];?></h2>
                      </div>
                    </div>
                      <hr>
          <?php
                      }
                    }else echo "You have currently have no products for sale";
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
