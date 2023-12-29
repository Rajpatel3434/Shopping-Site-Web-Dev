<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact Us</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Melissa Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <!-- <script src="scripts/script1.js" defer></script> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div>
        <div class="Area-1 Area-center login-area"> <!--Create account-->
          <h1>Contact Us</h1>
          <form method="POST" action="add-user.php">
            <ul>
              <li>First name:</li>
              <li><input type="text" name="fName"></li>
              <li>Last name:</li>
              <li><input type="text" name="lName"></li>
              <li>Phone:</li>
              <li><input type="text" name="phone"></li>
              <li>Email:</li>
              <li><input type="text" name="email"></li>
              <li>Description</li>
              <li><input type="text" name="description"></li>
              <input type="submit">
            </ul>
          </form>
        </div>
    </div>
  </body>
</html>