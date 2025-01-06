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
            if($user['Email'] === $_POST['email'] &&  password_verify($_POST['password'],$user['Password'] )){

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

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-login'])){
    $signininstance = new sign_in(null,null);
    $signininstance->signin();
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>game-vault | log in</title>
  <link rel="stylesheet" href="sign-in.css?<?php echo time() ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <form action="#" method="POST">
      <div class="logo-box">
        <div class="img-box">
          <img src="images/logogm-removebg-preview.png"  alt="Game vault">
       </div>
       <h1>login</h1>
      </div>
     
      <div class="input-box">
        <input type="email" name="email" placeholder="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="password" required>
        <i class="fas fa-lock"></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox" name="checkbox" id="">remember me</label>
        <a href="#">forgot password?</a>
      </div>
      <button type="submit" name="submit-login" class="btn">login</button>
      <div class="register-link">
        <p>don't have an account? <a href="sign-up.php">register</a></p>
      </div>
    </form>
  </div>
</body>
</html>