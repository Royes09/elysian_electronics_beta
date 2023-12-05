<?php

include 'server.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'Cosul a fost modificat';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elysian Electronics</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <?php include 'header.php'; ?><br><br><br>
    <section class="products">

        <h3 class="heading">Coșul tău</h3>

        <div class="box-container">

            <?php
  $grand_total = 0;
  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
  $select_cart->execute([$user_id]);
  if($select_cart->rowCount() > 0){
     while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
?>
            <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                <div class="name"><?= $fetch_cart['name']; ?></div>
                <div class="flex">
                    <div class="price"><?= $fetch_cart['price']; ?> RON</div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>">
                    <button type="submit" class="ri-edit-2-fill" name="update_qty"></button>
                </div>
                <div class="sub-total"> sub total :
                    <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?> RON</span> </div>
                <input type="submit" value="șterge" onclick="return confirm('Vrei să ștergi acest produs din coș?');"
                    class="delete-btn" name="delete">
            </form>
            <?php
$grand_total += $sub_total;
  }
}else{
  echo '<p class="empty">Coșul este gol</p>';
}
?>
        </div>

        <div class="wishlist-total">
        <p>Valoare totala: <span><?= $grand_total; ?> RON</span></p>
      <a href="index.php" class="btn">Continuă cumpărăturile</a>
      <a href="cart.php?delete_all" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Sigur vrei să ștergi coșul?');">Sterge toate produsele din coș</a>
      <a href="place.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Plasează comanda</a> </div>
    </section>
    <script src="js/script.js"></script>

</body>

</html>