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
        <h1 class="heading">Produse adaugate recent</h1>
        <div class="box-container">
            <?php
// First section
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    // Fetch all products into an array
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
    
    // Reverse the array to loop in descending order
    $products = array_reverse($products);
    
    // Loop through each product and echo its details
    foreach ($products as $row) {
        if ($i >= 8) {
            break; // Exit the loop if 8 products have been displayed
        }
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
    }
} else {
    echo '<div class="box">';
    echo "Nu există niciun produs momentan.";
    echo '</div>';
}
?>
        </div>
        <h1 class="heading">Laptopuri</h1>
        <div class="box-container">
            <?php
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $products = $result->fetchAll(PDO::FETCH_ASSOC);

    $products = array_reverse($products);
    
    foreach ($products as $row) {
        if ($i >= 8) {
            break; 
        }
        if($row['cat_id']==0){
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
        }
    }
}if ($i == 0){
    echo '<div class="box">';
    echo "Nu există niciun produs de acest tip momentan.";
    echo '</div>';
}
?>
        </div>
        <h1 class="heading">Mobile</h1>
        <div class="box-container">
            <?php
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $products = $result->fetchAll(PDO::FETCH_ASSOC);

    $products = array_reverse($products);
    foreach ($products as $row) {
        if ($i >= 8) {
            break; 
        }
        if($row['cat_id']==1){
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
        }
    }
}if ($i == 0){
    echo '<div class="box">';
    echo "Nu există niciun produs de acest tip momentan.";
    echo '</div>';
}
?>
        </div>
        <h1 class="heading">Gaming & Office</h1>
        <div class="box-container">
            <?php
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $products = array_reverse($products);
    
    foreach ($products as $row) {
        if ($i >= 8) {
            break;
        }
        if($row['cat_id']==2){
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
        }
    }
}if ($i == 0){
    echo '<div class="box">';
    echo "Nu există niciun produs de acest tip momentan.";
    echo '</div>';
}
?>
        </div>
        <h1 class="heading">Componente</h1>
        <div class="box-container">
            <?php
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $products = array_reverse($products);
    
    foreach ($products as $row) {
        if ($i >= 8) {
            break;
        }
        if($row['cat_id']==3){
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
        }
    }
}if ($i == 0){
    echo '<div class="box">';
    echo "Nu există niciun produs de acest tip momentan.";
    echo '</div>';
}
?>
        </div>
        <h1 class="heading">Monitoare & Periferice</h1>
        <div class="box-container">
            <?php
$sql = "SELECT * FROM products";
$i = 0;
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
    
    $products = array_reverse($products);
    
    foreach ($products as $row) {
        if ($i >= 8) {
            break;
        }
        if($row['cat_id']==4){
        echo '<div class="box">';
        echo '<form action="" method="post">';
        echo '<img src="uploaded_img/' . $row["image_01"] . '"><hr>';
        echo  '<input type="hidden" name="pid" value="' . $row['id'] .'">';
        echo  '<input type="hidden" name="name" value="' . $row['name'] .'">';
        echo  '<input type="hidden" name="price" value="' . $row['price'] .'">';
        echo  '<input type="hidden" name="image" value="' . $row['image_01'] .'">';
        echo   $row["name"] . "<br>";
        echo  '<p>'.$row["price"] . ' RON </p><div class="butoane_prod">';
        echo '<a href="quick_view.php?pid='.$row["id"].'" class="ri-eye-fill"></a>';
        echo '<button class="ri-heart-fill" type="submit" name="add_to_wishlist"></button><div><input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"><input type="submit" value="Cumpără" class="btn" name="add_to_cart"></div></div>';
        echo '';
        echo '</form></div>';
        $i++;
        }
    }
}if ($i == 0){
    echo '<div class="box">';
    echo "Nu există niciun produs de acest tip momentan.";
    echo '</div>';
}
?>
        </div>
    </section>
</body>

</html>