<?php 
    $session_id=session_id();
    $total = 0;
    $sqlTotal = "SELECT cart.product_id, cart.quantity, products.price
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    WHERE cart.session_id = '$session_id';";

    if ($resultTotal = mysqli_query($conn, $sqlTotal)){
        
        if(mysqli_num_rows($resultTotal) > 0) {
            while ($rowTotal = mysqli_fetch_assoc($resultTotal)){
                $total += ($rowTotal['price']* $rowTotal['quantity']);
            }mysqli_free_result($resultTotal);
        }
    } mysqli_close($conn);