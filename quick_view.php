<?php

include 'server.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'favorite.php';

?>

<!DOCTYPE html>
<html lang="en" : <head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elysian Electronics</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <h1 class="heading">Vizualizare produs</h1>

    <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
        <div class="image-container">
            <div class="sub-image">
                <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
                <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
        </div>
        <div class="content">
            <h2><?= $fetch_product['name']; ?></h2>
            <h3>Specificații:</h3>
            <?= $fetch_product['details']; ?><br>
            <h3><span>Pret: </span><?= $fetch_product['price']; ?><span>RON</span></h3>
            <div class="flex-btn">
                <div>
                    <input type="number" name="qty" class="qty" min="1" max="99"
                        onkeypress="if(this.value.length == 2) return false;" value="1">
                    <input type="submit" value="Adaugă în coș" class="btn" name="add_to_cart">
                </div>
                <input class="option-btn" type="submit" name="add_to_wishlist" value="Adaugă la favorite">
            </div>
        </div>
    </form>
    <?php
      }
   }else{
      echo '<p class="empty">Nu exista produse</p>';
   }
   ?>
</body>

</html>