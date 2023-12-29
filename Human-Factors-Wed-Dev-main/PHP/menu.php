
<nav>

    <div id="menu">
        <a href="index.php">[Site name]</a>
        <div class="dropdown">
            <button class="dropbutton">Products</button>

            <?php
                require_once "PHP/dbconn.inc.php";

                //product page tab
                $sql = "SELECT products_category.cat_id, cat_name
                FROM products_category
                JOIN products ON  products.cat_id = products_category.cat_id
                WHERE user_id is NULL
                GROUP BY cat_name,products_category.cat_id
                HAVING COUNT(cat_name) > 0
                ORDER BY cat_name;";
                echo "<div class=\"dropdown-content\">";
                if ($result = mysqli_query($conn, $sql)){
                    
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<a href=\"productsearch.php?id=" . $row["cat_id"] . "&user_id=NULL\">";
                            echo $row["cat_name"];
                            echo "</a>";
                        }mysqli_free_result($result);
                    }
                } 
                echo "</div>";
                ?>
        </div>

        <a href="Contact.php">Contact</a>

        <div class="icons">
            <a href="productsearch.php" class="search_btn"><img src ="Images/search.png"></a>
            
            <div class="dropdown">
                <button class="search_btn dropbutton "><img src ="Images/Login.png"></button>
                <div class="dropdown-content">
                    <?php 
                    if(isset($_SESSION['user_id'])){
                        echo "<a href=\"profile.php\">Profile</a>";
                        echo "<a href=\"logout.php\">Logout</a>";
                    }
                    else{
                        echo "<a href=\"login.php\">Login</a>";
                        echo "<a href=\"create-account.php\">Create Account</a>";
                    }
                    ?>
                </div>
                    
            </div>
            

            <a href="ShoppingCart.php" class="search_btn"><img src ="Images/Cart.png"></a>
        </div>
    </div>
</nav>





