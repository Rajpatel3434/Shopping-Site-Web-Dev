<?php
session_start();

if (isset($_POST['cardholder'], $_SESSION['cart-total'], $_POST['card_no'], $_POST['expiry'], $_POST['CSV'])) {
    require_once "PHP/dbconn.inc.php"; 
    $total = $_SESSION['cart-total'];
    $card_no = password_hash($_POST['card_no'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO payment_details(card_name,amount,card_number,expiry,csv) VALUES(?,$total,?,?,?);";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'sssi', 
        htmlspecialchars($_POST['cardholder']),
        htmlspecialchars($card_no), 
        htmlspecialchars($_POST['expiry']), 
        htmlspecialchars($_POST['CSV'])); 
    mysqli_stmt_execute($statement);
    $_SESSION['payment_id'] = mysqli_insert_id($conn);
    mysqli_error($conn);
    header("location: OrderSummery.php"); 
} mysqli_close($conn);

