<?php
include 'server.php';


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';



if(isset($_POST['order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
 
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);
 
    if($check_cart->rowCount() > 0){
 
       $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
       $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
 
       $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
       $delete_cart->execute([$user_id]);
 
       $message[] = 'order placed successfully!';
    }else{
       $message[] = 'your cart is empty';
    }
 
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
<h1 class="heading">Comenzi</h1>


<form action="" method="POST">

<h3>PRODUSE</h3>
<hr>

   <div class="display-orders">
   <?php
      $grand_total = 0;
      $cart_items[] = '';
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
            $total_products = implode($cart_items);
            $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
   ?>
      <p> <?= $fetch_cart['name']; ?> <span>(<?= $fetch_cart['price'].'RON  x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
         }
      }else{
         echo '<p class="empty">your cart is empty!</p>';
      }
   ?>
      <input type="hidden" name="total_products" value="<?= $total_products; ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
      <div class="grand-total">Total: <span><?= $grand_total; ?> RON</span></div>
   </div>

   <h3>PLASEAZA COMANDA</h3><hr><br>

   <div class="flex">
      <div class="inputBox">
         <span>Numele :</span>
         <input type="text" name="name" placeholder="Popescu" class="box" maxlength="20" required>
      </div>
      <div class="inputBox">
         <span>Telefon :</span>
         <input type="number" name="number" placeholder="0771033732" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
      </div>
      <div class="inputBox">
         <span>Email :</span>
         <input type="email" name="email" placeholder="ex@gmail.com" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>payment method :</span>
         <select name="method" class="box" required>
            <option value="ramburs">Ramburs</option>
            <option value="credit card">Card</option>
            <option value="paypal">paypal</option>
         </select>
      </div>
      <div class="inputBox">
         <span>Adresa 01 :</span>
         <input type="text" name="flat" placeholder="Aleea Studentilor" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Adresa 02 :</span>
         <input type="text" name="street" placeholder="Cămin C17" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Oraș :</span>
         <input type="text" name="city" placeholder="Timișoara" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Județ :</span>
         <input type="text" name="state" placeholder="Timiș" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>Țara :</span>
         <input type="text" name="country" placeholder="Romania" class="box" maxlength="50" required>
      </div>
      <div class="inputBox">
         <span>zip code :</span>
         <input type="number" min="0" name="pin_code" placeholder="230057" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
      </div>
   </div>

   <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Plasează comanda">

</form>
</body>
</html>