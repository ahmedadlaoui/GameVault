<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user|profile</title>
  <link rel="stylesheet" href="user-profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="menu">
    <ul>
      <li class="profile">
        <div class="img-box">
          <img src="img/dash-board-Gamal.webp" alt="profile">
        </div>
        <h2>nick-name</h2>
      </li>
      <li class="active">
        <a href="#">
          <i class="fas fa-person"></i>
          <p>profile</p>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-gamepad"></i>
          <p>my library</p>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-wand-magic-sparkles"></i>
          <p>list wishes</p>
        </a>
      </li>
      <li>
        <a href="#" class="active">
          <i class="fas fa-pen"></i>
          <p>edit info</p>
        </a>
      </li>


      <li class="log-out">
        <a href="#">
          <i class="fas fa-sign-out"></i>
          <p>log-out</p>
        </a>
      </li>

    </ul>
  </div>

  <div class="content">
    <div class="title-info">
      <p>statist</p>
      <i class="fas fa-chart-pie"></i>
    </div>

    <div class="data-info">
      <div class="box">
        <i class="fas fa-coins"></i>
        <div class="data">
          <p>score</p>
          <span>180</span>
        </div>
      </div>

      <div class="box">
        <i class="fas fa-trophy"></i>
        <div class="data">
          <p>record</p>
          <span>280</span>
        </div>
      </div>

      <div class="box">
        <i class="fas fa-user-group"></i>
        <div class="data">
          <p>friends</p>
          <span>380</span>
        </div>
      </div>

      <div class="box">
        <i class="fas fa-crown"></i>
        <div class="data">
          <p>Global rank</p>
          <span>480</span>
        </div>
      </div>




    </div>

    <div class="title-info">
      <p>user-info</p>
      <i class="fas fa-table"></i>
    </div>

    <form action="#" method="POST">
      <div>
        <label for="user-name"><span>name</span></label>
        <input type="text" name="name" id="user-name" value="mohamed">
      </div>
      <div>
       <label for="user-email"><span>email</span></label> 
        <input type="email" name="email" id="user-email" value="email@email.com">
      </div>

      <div class="password" >
        <input type="password" name="current-password" id="current-password" placeholder="current password" required>
        <input type="password" name="new-password" id="new-password" placeholder="new password" required>
        <input type="password" name="confirme-password" id="confirme-password" placeholder="confirm password" required>
      </div>

      <button type="submit">save changes</button>
    </form>



  </div>

</body>
</html>