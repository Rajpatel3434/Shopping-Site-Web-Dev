<?php 
  session_start();
  if (isset($_SESSION['user_id'])){
    header("location: profile.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Bradley Pelham" />
    <link rel="stylesheet" href="style/style.css"> 
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>

  <body id="grad">
    <?php require_once "PHP/menu.php"; ?>
    <div class="Area-1 Area-center login-area">
    <?php
      $error ='';
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
              $email = trim($_POST['email']);
              $password = trim($_POST['password']);

              if (empty($email)){ //check if email and password are empty
                  $error .= '<p>Please enter email</p>';
              }
              if (empty($password)){
                  $error .= "<p>Please enter password</p>";
              }

              if (empty($error)){
                  $sql = "SELECT user_id, password FROM customer WHERE email = ?;";
                  if ($query = $conn->prepare($sql)){
                      $query->bind_param('s', $email);
                      $query->execute();
                      $query->store_result();
                      $query->bind_result($id, $dbPassword);
                      $row = $query->fetch();
                      
                      if($row){
                          if (password_verify($password, $dbPassword)){
                              $_SESSION['user_id'] = $id;
                              header("location: profile.php");
                          }else {
                              $error .= "<p>Incorrect password</p>";
                          }
                      }else {
                          $error .= "<p>No account exist with that email</p>";
                      }
                  }
              }
            }
          ?>
       <!--login-->
        <h1>Login</h1>
        <?php
            echo $error;
          ?>
        <form method="POST" action="">
          
          <ul>
            <li>Email: </li>
            <li><input type="text" name ="email" ></li>
            <li>Password:</li>
            <li><input type="password" name = "password" required></li>
            <input type="submit" name = "submit">
            <li>Don't have an account? <a href="create-account.php">Create one here</a> </li>
          </ul>
        </form>
    </div>
  </body>
</html>
