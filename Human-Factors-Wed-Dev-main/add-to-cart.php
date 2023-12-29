<?php
 session_start();
 $productID = $_GET['prodId'];
 $quantity  = $_GET['quantity']; /// connect to add button
 
$session = session_id();
require_once "PHP/dbconn.inc.php"; 
$sql = "SELECT quantity FROM cart WHERE session_id = ? AND product_id = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('si', $session ,$productID);
    $query->execute();
    $query->store_result();
    $query->bind_result($quantityDB);
    $row = $query->fetch();
    if (isset($session) && isset($productID) && isset($quantity)) {
        if($row){// checks if there is already in the database
            $sql2 = "UPDATE cart SET quantity = ? WHERE session_id = ? AND product_id = ?;";
            $quantSum = $quantity + $quantityDB;
            $statement = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($statement, $sql2);
            mysqli_stmt_bind_param($statement, 'isi', htmlspecialchars($quantSum), htmlspecialchars($session), htmlspecialchars($productID)); 
            mysqli_stmt_execute($statement);
            mysqli_error($conn);
            header("location: ShoppingCart.php"); 
            mysqli_close($conn);
        }else{// if not in db it will insert new entry 
        
            $sql2 = "INSERT INTO cart(session_id,product_id,quantity) VALUES(?,?,?);";
            $statement = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($statement, $sql2); 
            mysqli_stmt_bind_param($statement, 'sii', htmlspecialchars($session),htmlspecialchars($productID),htmlspecialchars($quantity)); 
            mysqli_stmt_execute($statement);
            mysqli_error($conn);
            header("location: ShoppingCart.php"); 
            mysqli_close($conn);
        }
    
    }mysqli_free_result($result);
