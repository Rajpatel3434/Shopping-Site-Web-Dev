<?php
  session_start();
?>
<html>
    <head>
        <title>Product search</title>
        <meta charset="UTF-8" />
        <meta name="Raj" content="productsearchpage" />
        <!-- <script src="Scripts/script1.js" defer></script> -->
        <link rel="stylesheet" href="style/style.css">
        <script src="Scripts/script1.js" defer></script>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    </head>
    <body id="grad">
        <?php require_once "PHP/menu.php"; ?>

         <!-- search bar -->
        <form class="wrapper" method="GET" action="productsearch.php">
            <div class="search_box">
                <div class="search_btn" > <img src ="Images/search.png"></i></div>
                <input type="text" name="q" placeholder="What are you looking for?">
                <input type="submit" name="submit" value="Search">
            </div>
        </form>

   


        <div class="search-sum">

           
            <ul class="Area-search search-grid">
                
                <?php  
              

                    if(isset($_GET['id']))
                    {
                        $sql = "SELECT * 
                        FROM products
                        where cat_id = $_GET[id];
                        
                        ;";
                    }elseif(isset($_GET['q'])){
                        $q = $_GET['q'];
                        $sql = "SELECT * FROM products WHERE product_keywords LIKE '%$q%';";
                    }else{
                        $sql = "SELECT * 
                        FROM products;";
                    }
                
                   

            
                    if ($result = mysqli_query($conn, $sql)){
                        
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<li class=\"search-items\">";
                                echo "<img src=\"" . $row["images"]. "\" href=\"productpage.php\">";
                                echo "<a href=\"productdesc.php?id=" . $row["product_id"] . "\">" . $row["productName"] . "</a>";
                                echo "<h3> $". $row["price"] . "</h3>";
                                echo "<form action=\"add-to-cart.php\" method=\"GET\">";
                                echo "<span class=\"minus\" onClick=\"decreaseCount(event, this)\">-</span>";
                                echo "<input type=\"amount\" NAME='quantity' value=\"1\">
                                <span class=\"plus\" onClick=\"increaseCount(event, this)\">+</span>";
                                echo "<INPUT TYPE=HIDDEN NAME='prodId' value='". $row['product_id']."'/>";
                                echo "<input type=\"submit\" name = \"add-cart\" value=\"Add to Cart\"></input>";
                                echo "</form>";
                                echo "</li>";
                            }
                           
                            
                            
                            mysqli_free_result($result);
                            
                        }
                        else {
                            echo " No matches found! ";

                        }
                    
                    } 
                   
                    mysqli_close($conn);

    


                ?>
  



    
            </ul>
        </div> 
    </body>
</html>