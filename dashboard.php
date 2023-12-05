<?php
include 'connect.php';
session_start();

if ($_SESSION['admin'] == 0) {
    header('location: index.php');
    exit(); // Added exit() to stop script execution after redirection
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

include 'favorite.php';
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

   <section class="dashboard">

<h1 class="heading">dashboard</h1>

<div class="box-container">

   <div class="box">
      <h3>Admin</h3>
      <p><?= $_SESSION['username']; ?></p>
      <a href="cont.php" class="btn">Actualizează parolă</a>
   </div>

   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         if($select_pendings->rowCount() > 0){
            while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
               $total_pendings += $fetch_pendings['total_price'];
            }
         }
      ?>
      <h3><?= $total_pendings; ?><span> RON</span></h3>
      <p>total în așteptare</p>
      <a href="orders.php" class="btn">Vezi comenzi</a>
   </div>

   <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         if($select_completes->rowCount() > 0){
            while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
               $total_completes += $fetch_completes['total_price'];
            }
         }
      ?>
      <h3><span></span><?= $total_completes; ?><span> RON</span></h3>
      <p>comenzi onorate</p>
      <a href="orders.php" class="btn">Vezi comenzi</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount()
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>comenzi plasate</p>
      <a href="orders.php" class="btn">Vezi comenzi</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount()
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>produse în stoc</p>
      <a href="products.php" class="btn">Vezi produs</a>
   </div>

   <div class="box">
   <?php
      $select_users = $conn->prepare("SELECT COUNT(*) as count FROM `users` WHERE `admin` = 0");
      $select_users->execute();
      $result = $select_users->fetch(PDO::FETCH_ASSOC);
      $number_of_users = $result['count'];
   ?>
   <h3><?= $number_of_users; ?></h3>
   <p>Utilizatori</p>
   <a href="users.php" class="btn">Vezi Utilizatori</a>
</div>

   <div class="box">
   <?php
      $select_admins = $conn->prepare("SELECT COUNT(*) as count FROM `users` WHERE `admin` = 1");
      $select_admins->execute();
      $result = $select_admins->fetch(PDO::FETCH_ASSOC);
      $number_of_admins = $result['count'];
   ?>
   <h3><?= $number_of_admins; ?></h3>
   <p>admini</p>
   <a href="admins.php" class="btn">Vezi admini</a>
</div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount()
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>plângeri</p>
      <a href="#" class="btn">Vezi plangeri</a>
   </div>

</div>

</section>
</body>

</html>