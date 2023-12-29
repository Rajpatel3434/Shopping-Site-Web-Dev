<?php
  session_start();

if (isset($_SESSION['user_id'])){
  header("location: profile.php");
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Create Account</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Bradley Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <!-- <script src="scripts/script1.js" defer></script> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "PHP/menu.php"; 
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
      $fName = trim($_POST['fName']);
      $lName = trim($_POST['lName']);
      $bday = trim($_POST['bday']);
      $phone = trim($_POST['phone']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $rePassword = trim($_POST['rePassword']);
      
      if($statement = $conn->prepare("SELECT * FROM customer WHERE email = ?;") ){
        
        $statement->bind_param('s', $email);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows > 0){
          $error .= "<p>Account with this email already exists</p>";
        }else{
          if(empty($rePassword)){
            $error  .= '<p>Password did not match</p>';
          }else{
            if($error && $password != $rePassword){
              $error .= "<p>Password did not match</p>";
            }
          }
          if (empty($error)){
            $passHash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO customer(fName,lName,bDay,email,password) 
            VALUES(?, ?, ?, ?, ?);";
            $statement2 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($statement2, $sql);
            mysqli_stmt_bind_param($statement2, "sssss", 
              htmlspecialchars($_POST['fName']), 
              htmlspecialchars($_POST['lName']), 
              htmlspecialchars($_POST['bday']),
              htmlspecialchars($_POST['email']), 
              htmlspecialchars($passHash));
              $result=mysqli_stmt_execute($statement2);
            if ($result){
              header('location: profile.php');
                
            }else{
              $error .= '<p>Something went wrong</p>';
            }
          }
        }
      }
    }mysqli_close($conn);
    ?>

    <div>
      <div class="Area-1 Area-center login-area"> <!--Create account-->
        <h1>Create account</h1>
        <?php echo $error; ?>
        <form method="POST" action="">
          <ul>
            <li>First name:</li>
            <li><input type="text" name="fName" require></li>
            <li>Last name:</li>
            <li><input type="text" name="lName"require></li>
            <li>Birthday:</li>
            <li><input type="date" name="bday"require></li>
            <li>Phone:</li>
            <li><input type="text" name="phone"></li>
            <li>Email:</li>
            <li><input type="email" name="email"require></li>
            <li>Password:</li>
            <li><input type="password" name="password"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
            title="Password requires at least one number, one uppercase, one lowercase letter, and must be at least 6 or more characters" required></li>
            <li>Confirm Password:</li>
            <li><input type="password" name="rePassword"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
            title="Password requires at least one number, one uppercase, one lowercase letter, and must be at least 6 or more characters" required></li>
            <!-- <div id="message">
              <h3>Password must contain the following:</h3>
              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
              <p id="number" class="invalid">A <b>number</b></p>
              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div> -->
            
            <input type="submit"  name = "submit">
            <li>Already have an account? <a href="login.php">Login here</a> </li>
          </ul>
        </form>
          
        
      </div>
    </div>
  </body>
</html>
