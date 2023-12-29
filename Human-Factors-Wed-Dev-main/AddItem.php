<?php 
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Item</title>
    <meta charset="UTF-8" />
    <meta name="author" content= "Melissa Pelham" />
    <link rel="stylesheet" href="style/Style.css"> 
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  </head>
  <body id="grad">
    <?php require_once "PHP/menu.php"; 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
      if (isset($_POST['title'], $_POST['price'], $_POST['category'],$_POST['description'])) {
        $price = $_POST['price'];
        $name = $_POST['title'];
        $cat = $_POST['category'];
        $disc = $_POST['description'];
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO products(productName,cat_id,price,productDesc,user_id) 
          VALUES($name,$cat,$price,$disc,$user_id);";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql); 
        // mysqli_stmt_bind_param($statement, 'sisi', 
        //     htmlspecialchars($_POST['title']),
        //     htmlspecialchars($_POST['category']), 
        //     // htmlspecialchars($_POST['price']), 
        //     htmlspecialchars($_POST['description']),
        //     htmlspecialchars($_SESSION['user_id'])); 
        mysqli_stmt_execute($statement);
        mysqli_error($conn);
        header("location: profile.php"); 
      }
    }?>
    <div>
        <div class="Area-1 Area-center login-area"> 
          <h1>Add Item</h1>
          <form method="POST" action="">
            <ul>
              <li>Title</Title></li>
              <li><input type="text" name="title"></li>
              <li>Price</li>
              <li><input type="text" name="price"></li>
              <li>Category</li>
              <li><select id="cat" name="category">
              <?php
                $sql = "SELECT cat_name, cat_id FROM products_category;";
                if ($result = mysqli_query($conn, $sql)){
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<option value=\"" .$row['cat_id'] ."\">" . $row['cat_name']. "</option>";
                        }mysqli_free_result($result);
                    }
                } mysqli_close($conn);
              ?>
              </select>
              </li>
              <li>Description</li>
              <li><input type="text" name="description"></li>
              <input type="submit">
            </ul>
          </form> 
        </div>
    </div>
  </body>
</html>