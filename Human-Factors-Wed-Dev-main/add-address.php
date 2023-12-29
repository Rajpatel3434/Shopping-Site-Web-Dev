<?php
session_start();

if (isset($_POST['address'], $_POST['country'], $_POST['city'],$_POST['postcode'])) {
    require_once "PHP/dbconn.inc.php"; 
    $sql = "INSERT INTO user_address(user_id,address,country,city,postcode) 
    VALUES(?,?,?,?,?);";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssssi', 
        htmlspecialchars($_SESSION['user_id']),
        htmlspecialchars($_POST['address']), 
        htmlspecialchars($_POST['country']), 
        htmlspecialchars($_POST['city']), 
        htmlspecialchars($_POST['postcode'])); 
    mysqli_stmt_execute($statement);
    mysqli_error($conn);
    header("location: Payment.php"); 
    mysqli_close($conn);
} 