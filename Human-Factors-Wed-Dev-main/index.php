<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title> [Site Name]</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Bradley Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <script src="scripts/script1.js" defer></script>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "php/menu.php";
    mysqli_close($conn); ?>
    
    <div class = "index">
      <div class="banner">
        <div>
          <h5>Welcome to the site</h5>
        </div>  
      </div>
    </div>
  </body>
</html>
