<?php
  session_start();

if (!isset($_SESSION['user_id'])){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Bradley Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <!-- <script src="scripts/script1.js" defer></script> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div class="cart-sum Area-center">
      <?php require_once "PHP/account menu.php"; ?>
      
      <div class="Area-2 profile-area">
        <h1>Profile</h1>
        <hr>
        <h4>My details</h4>
        
        <?php
          $sql = "SELECT * FROM `customer` WHERE user_id = $_SESSION[user_id];";
          if ($result = mysqli_query($conn, $sql)){
            $row = mysqli_fetch_assoc($result);
              ?>
              <dl>
                <dt>First name:</dt>
                <dd><?php echo $row['fName']?></dd>
                <dt>last name:</dt>
                <dd><?php echo $row['lName']?></dd>
                <dt>Birthday:</dt>
                <dd><?php echo $row['bDay']?></dd>
                <dt>Email:</dt>
                <dd><?php echo $row['email']?></dd>
                <a href="Logout.php">Logout</a>
              </dl>
          <?php mysqli_free_result($result);
        } 
        mysqli_close($conn);
?>
        
      </div>
    </div>
  </body>
</html>