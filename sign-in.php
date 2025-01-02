<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>game-vault | log in</title>
  <link rel="stylesheet" href="sign-in.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <form action="#">
      <div class="logo-box">
        <div class="img-box">
          <img src="img/logo.png"  alt="Game vault">
       </div>
       <h1>login</h1>
      </div>
     
      <div class="input-box">
        <input type="email" placeholder="email" required>
        <i class="fas fa-envelope"></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="password" required>
        <i class="fas fa-lock"></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox" name="checkbox" id="">remember me</label>
        <a href="#">forgot password?</a>
      </div>
      <button type="submit" class="btn">login</button>
      <div class="register-link">
        <p>don't have an account? <a href="#">register</a></p>
      </div>
    </form>
  </div>
</body>
</html>