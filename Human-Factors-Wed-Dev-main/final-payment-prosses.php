<?php
session_start();

if (isset($_SESSION['user_id'], $_SESSION['payment_id'])) {
    // makes a order entry in order_details
    require_once "PHP/dbconn.inc.php"; 
    $payment_id = $_SESSION['payment_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO order_details(user_id,payment_id) VALUES($user_id,$payment_id);";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_execute($statement);
    $order_id = mysqli_insert_id($conn);
    mysqli_error($conn);
    
    //moves info from cart to order_items
    $session_id = session_id();
    $sql = "SELECT product_id, quantity
        FROM cart
        WHERE session_id = '$session_id';";
    
    if ($result = mysqli_query($conn, $sql)){
        if (mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];
                $sql2 = "INSERT INTO order_items VALUES($order_id, $product_id, $quantity);";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql2); 
                mysqli_stmt_execute($statement);

            } 
            mysqli_free_result($result);
        }
    } 
     //removes the cart items to do with current session

    $sql = "DELETE FROM cart
    WHERE session_id = '$session_id';";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_execute($statement);
    mysqli_error($conn);
    header("location: OrderConfirmed.php");
} 







mysqli_close($conn);
