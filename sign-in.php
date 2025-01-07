<?php
require_once 'dbconn.php';

session_start();

class sign_in{

    private $email;
    private $password;

    public function __construct($email,$password){

        $this-> email = $email;
        $this-> password = $password;
    }

    public function signin(){
        $dbconnection = dbconnection::Getinstanse();
        $connection = $dbconnection->getconnection();

        $stmt = $connection->prepare("SELECT * FROM users");
        $stmt->execute();
        $users_array = $stmt->FetchALL(PDO::FETCH_ASSOC);

        foreach($users_array as $user){
            if($user['Email'] === $_POST['email'] &&  base64_encode($_POST['password']) === $user['Password'] ){

                $_SESSION['user_ID'] = $user['User_ID'];
                $_SESSION['Nickname'] = $user['Nick_Name'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Role'] = $user['Role'];
                $_SESSION['status'] = $user['Banned'];
                $_SESSION['Profile_Pic'] = $user['Profile_Pic'];

                header("location: index.php");
            }
        }

    }

    public static function signout(){
        session_destroy();
        session_unset();
    }

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-login'])){
    $signininstance = new sign_in(null,null);
    $signininstance->signin();
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log-out'])){
    sign_in::signout();
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>game-vault | log in</title>
<<<<<<< HEAD
  <link rel="stylesheet" href="sign-in.css">
=======
  <link rel="stylesheet" href="sign-in.css?<?php echo time() ?>">
>>>>>>> 053aa504af142d50c3fc4e3e6306bad6914ed842
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
<<<<<<< HEAD
    <form action="#">
      <div class="logo-box">
        <div class="img-box">
          <img src="img/logo.png"  alt="Game vault">
=======
    <form action="#" method="POST">
      <div class="logo-box">
        <div class="img-box">
          <img src="images/logogm-removebg-preview.png"  alt="Game vault">
>>>>>>> 053aa504af142d50c3fc4e3e6306bad6914ed842
       </div>
       <h1>login</h1>
      </div>
     
      <div class="input-box">
<<<<<<< HEAD
        <input type="email" placeholder="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="password" required>
=======
        <input type="email" name="email" placeholder="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="password" required>
>>>>>>> 053aa504af142d50c3fc4e3e6306bad6914ed842
        <i class="fas fa-lock"></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox" name="checkbox" id="">remember me</label>
        <a href="#">forgot password?</a>
      </div>
<<<<<<< HEAD
      <button type="submit" class="btn">login</button>
      <div class="register-link">
        <p>don't have an account? <a href="#">register</a></p>
=======
      <button type="submit" name="submit-login" class="btn">login</button>
      <div class="register-link">
        <p>don't have an account? <a href="sign-up.php">register</a></p>
>>>>>>> 053aa504af142d50c3fc4e3e6306bad6914ed842
      </div>
    </form>
  </div>
</body>
</html>