<?php

include 'connect.php';
session_start();

// initializare variabile
$username = "";
$email    = "";
$errors = array(); 

// conectare la database
$db_name = 'pcgarbage';
$db_user = 'root';
$db_password = '';

$conn = new PDO("mysql:host=localhost;dbname=$db_name", $db_user, $db_password);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // primire variabile
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // validare formular: asigurați-vă că formularul este completat corect...
  // adăugând (array_push()) eroarea corespunzătoare în tabloul $errors
  if (empty($username)) { array_push($errors, "- Numele de utilizator este obligatoriu"); }
  if (empty($email)) { array_push($errors, "- Emailul este obligatoriu"); }
  if (empty($password_1)) { array_push($errors, "- Parola este obligatorie"); }
  if ($password_1 != $password_2) {
	array_push($errors, "- Parolele nu se potrivesc");
  }
  // mai întâi verific baza de date 
  // un utilizator nu există deja cu același nume de utilizator și/sau e-mail
  $user_check_query = "SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1";
  $stmt = $conn->prepare($user_check_query);
  $stmt->execute(['username' => $username, 'email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($user) { // daca exista utilizatorul
    if ($user['username'] === $username) {
      array_push($errors, "- Numele de utilizator este luat");
    }

    if ($user['email'] === $email) {
      array_push($errors, "- Email-ul este deja folosit de alt utilizator");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);//cryptarea parolei inainte de scrierea in baza de date
  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES(:username, :email, :password)";
  	$stmt = $conn->prepare($query);
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
    $user_id = $conn->lastInsertId();
    $_SESSION['admin'] = 0;
    $_SESSION['user_id'] = $user_id;
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Acum ești autententificat";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $username = filter_var($username, FILTER_SANITIZE_STRING);
  $password = $_POST['password'];
  $password = filter_var($password, FILTER_SANITIZE_STRING);
  $password = md5($password);

  $errors = array();

  if (empty($username)) {
     array_push($errors, "- Numele de utilizator este obligatoriu");
  }
  if (empty($password)) {
     array_push($errors, "- Parola este obligatorie");
  }

  if (count($errors) == 0) {
     $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND password = ?");
     $select_user->execute([$username, $password]);
     $row = $select_user->fetch(PDO::FETCH_ASSOC);

     if($select_user->rowCount() > 0){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['username'] = $row['username'];
        header('location:index.php');
     } else {
      array_push($errors, "- Nume de utilizator/parolă greșite");
     }
  }
}

?>
