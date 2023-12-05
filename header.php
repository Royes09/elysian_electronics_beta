<header>
    <a href="index.php" class="logo"><i class="ri-computer-fill"></i><span>Elysian</span></a>
    <ul class="navbar">
        <li><a href="laptopuri.php">Laptop</a></li>
        <li><a href="mobile.php">Mobile</a></li>
        <li><a href="gamoff.php">Gaming&Office</a></li>
        <li><a href="comps.php">Componente</a></li>
        <li><a href="per.php">Monitoare&Periferice</a></li>
    </ul>
    <div class="main">
        <?php 

        if (!isset($_SESSION['user_id'])) 
        {
  	    echo '<a href="login.php" class="user"><i class="ri-login-box-fill"></i>Sign In</a>';
        }
	    else {
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
            if ($_SESSION['admin']==1) 
            {
                echo '<a href="dashboard.php" class="user"><i class="ri-dashboard-line"></i>Dashboard</a>';
            }
            echo '<a href="cont.php" class="user"><i class="ri-user-fill"></i>Cont</a>
        <a href="wishlist.php" class="user"><i class="ri-heart-2-fill"></i>Favorite('.$total_wishlist_counts.')</a>
        <a href="cart.php" class="user"><i class="ri-shopping-cart-fill"></i>Coș('.$total_cart_counts.')</a>
        <a href="logout.php" class="user"><i class="ri-logout-box-r-fill"></i>Logout</a>';
        }
        ?>
        <div class="bx bx-menu" id="menu-icon"></div>
    </div>
</header>
<script type="text/javascript" src="js/script.js"></script>