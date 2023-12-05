<?php
session_start();
include 'server.php';


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

$message = [];

if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
 
    $update_profile = $conn->prepare("UPDATE `users` SET username = ? WHERE id = ?");
    $update_profile->execute([$username, $user_id]);

    $fetch_profile_stmt = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $fetch_profile_stmt->execute([$user_id]);
    $fetch_profile = $fetch_profile_stmt->fetch(PDO::FETCH_ASSOC);

    $empty_pass = 'd41d8cd98f00b204e9800998ecf8427e';
    $prev_pass = isset($fetch_profile["password"]) ? $fetch_profile["password"] : '';
    $old_pass = md5($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = md5($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = md5($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    if(empty($old_pass)){
       $message[] = 'Introdu parola veche.';
    } elseif($old_pass != $prev_pass){
       $message[] = 'Parola veche nu se potriveste.';
    } elseif($new_pass != $cpass){
       $message[] = 'Parolele nu se potrivesc.';
    } else {
       if($new_pass != $empty_pass){
          $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
          $update_admin_pass->execute([$new_pass, $user_id]);
          $message[] = 'Parola schimbata cu succes!';
       } else {
          $message[] = 'Introdu o parola noua.';
       }
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
    <section class="products">
        <div class="box-container">
            <div class="box">
                <form action="" method="post">
                    <h3 class="heading">Actualizare parola</h3>
                    <input type="text" name="username" required placeholder="introdu username-ul" maxlength="20" class="box" value="<?= isset($fetch_profile["username"]) ? $fetch_profile["username"] : ''; ?>"><br>
                    <input type="email" name="email" required placeholder="introdu email-ul" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= isset($fetch_profile["email"]) ? $fetch_profile["email"] : ''; ?>"><br>
                    <input type="password" name="old_pass" placeholder="introdu parola veche" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')"><br>
                    <input type="password" name="new_pass" placeholder="introdu parola noua" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')"><br>
                    <input type="password" name="cpass" placeholder="confirma parola noua" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')"><br>
                    <input type="submit" value="Actualizeaza" class="btn" name="submit">
                </form>
                <?php
                if (!empty($message)) {
                    foreach ($message as $msg) {
                        echo '<p>' . $msg . '</p>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>
