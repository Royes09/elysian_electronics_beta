<?php
include 'server.php';

if ($_SESSION['admin'] == 0) {
    header('location: index.php');
    exit(); // Added exit() to stop script execution after redirection
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';


if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_orders->execute([$delete_id]);
    $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
    $delete_messages->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:users.php');
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
    <?php include 'header.php'; ?>
    <section class="products">

   <h1 class="heading">user accounts</h1>

   <div class="box-container">

   <?php
   
      $select_accounts = $conn->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   if (!$fetch_accounts['admin']) {
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['username']; ?></span> </p>
      <p> email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <a href="users.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('stergi acest cont?')" class="btn">sterge</a>
   </div>
   <?php
         }
      }
      }else{
         echo '<p class="empty">Nu exista conturi</p>';
      }
   ?>

   </div>

</section>
</body>

</html>