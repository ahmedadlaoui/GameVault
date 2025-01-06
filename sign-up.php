<?php

require_once 'dbconn.php';

class signup
{

  private $nickname;
  private $email;
  private $password;

  public function __construct($nickname, $email, $password)
  {

    $this->nickname = $nickname;
    $this->email = $password;
    $this->nickname = $nickname;
  }

  public function signup()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();
    $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkStmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE Email = :email");
    $checkStmt->bindParam(':email',  $_POST['email']);
    $checkStmt->execute();
    $check = $checkStmt->fetchColumn();
    if ($check > 0) {
      return;
  }

    $stmt = $connection->prepare("INSERT INTO users (Nick_Name, Email, Password, Role) VALUES (:nickname, :email, :password, 'User')");
    $stmt->bindParam(':nickname', $_POST['nickname']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $hashedpassword);
    $stmt->execute();
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-signup'])) {
  $signupinstance = new signup(null, null, null);
  $signupinstance->signup();
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>game-vault | log in</title>
  <link rel="stylesheet" href="sign-up.css?<?php echo time() ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="wrapper">
    <form action="#" method="post">
      <div class="logo-box">
        <div class="img-box">
          <img src="images/logogm-removebg-preview.png" alt="Game vault">
        </div>
        <h1>sign-up</h1>
      </div>

      <div class="input-box">
        <input type="text" name="nickname" placeholder="nick-name" required>
        <i class="fas fa-user-secret"></i>
      </div>


      <div class="input-box">
        <input type="email" name="email" placeholder="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="password" required>
        <i class="fas fa-lock"></i>
      </div>
      <button type="submit" name="submit-signup" class="btn">sign-up</button>
    </form>
  </div>
</body>

</html>