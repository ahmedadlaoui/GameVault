<?php
require_once 'dbconn.php';
session_start();
ob_start();

class User
{
  private $nickname;
  private $Email;
  private $profilpic;

  public function __construct($nickname, $Email, $profilpic)
  {
    $this->nickname =  $nickname;
    $this->Email = $Email;
    $this->profilpic = $profilpic;
  }

  public static function fetchuser_infos()
  {

    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE User_ID = :user_id ");
    $stmt->bindParam(':user_id', $_SESSION['user_ID']);
    $stmt->execute();
    return  $stmt->Fetch(PDO::FETCH_ASSOC);
  }

  public static function edit_uuserinfos()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("UPDATE users SET Nick_Name = :currentuser,Email = :currentemail, Password = :currentpassword ");
    $stmt->bindParam(':currentuser', $_POST['name']);
    $stmt->bindParam(':currentemail', $_POST['email']);
    $stmt->bindParam(':currentpassword', password_hash($_POST['new-password'], PASSWORD_DEFAULT));
    $stmt->execute();
  }

  public static function fetchallusers()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    return  $stmt->FetchAll(PDO::FETCH_ASSOC);
  }
}

$user_infos = User::fetchuser_infos();
$users = User::fetchallusers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['savechanges'])) {
  user::edit_uuserinfos();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user profile</title>
  <link rel="stylesheet" href="user_dashboard.css?<?php echo time() ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  <div class="fakeheader"></div>


  <header>
    <ul>
      <a href="index.php"><img src="images/logogm-removebg-preview.png" alt="logo" id="logo"></a>
      <a href="">
        <li>PREMIUM</li>
      </a>
      <a href="" style="display: flex;">
        <li>DOWLOAD</li> <img src="images/download_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg" alt="">
      </a>
      <a href="" style="display: flex;">
        <li>Dashboard</li><img src="images/headset_mic_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg" alt="">
      </a>
    </ul>
    <a style="text-decoration: none;" href="sign-in.php"><button><img src="images/person_24dp_F3F3F3_FILL1_wght400_GRAD0_opsz24.svg" alt="">Log In</button></a>
  </header>


  <?php
  if ($_SESSION['Nickname']) {
    echo '<div class="sub-header" id="header">
    <ul>
        <a href="index.php">
            <li>Home</li>
        </a>
        <a href="">
            <li>Collection</li>
        </a>
        <a href="">
            <li>Feedbacks</li>
        </a>
    </ul>
    <form style="position: relative;">
        <button id="search"><img src="images/search_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg"></button>
        <input type="text" placeholder="Search for games">
    </form>
    <a href="" id="Wishlist">View Profile</a>
</div>';
  }


  ?>


  <div class="content">

    <div class="changeifos">
      <img src="images/detail1.jpg" alt="">

      <form action="#" method="POST">
        <div>
          <label for="user-name"><span>name</span></label>
          <input type="text" name="name" id="user-name" value="<?php echo  $user_infos['Nick_Name'] ?>">
        </div>
        <div>
          <label for="user-email"><span>email</span></label>
          <input type="email" name="email" id="user-email" value="<?php echo  $user_infos['Email'] ?>">
        </div>


        <div>
          <label for="new-password"><span>Current password</span></label>
          <input type="password" id="new-password" value="<?php echo  base64_decode($user_infos['Password']) ?>" required>
        </div>



        <div>
          <label for="confirme-password"><span>New password</span></label>
          <input type="password" name="new-password" id="confirme-password" placeholder="confirm password" required>
        </div>


        <button type="submit" name="savechanges">save changes</button>
      </form>
    </div>


    <div class="title-info">
      <H2>statist <i class="fas fa-chart-pie"></i></H2>
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






  </div>

  <main class="title-info">
    <h2>All available games :</h2>

    <div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
      <div class="slider-mmo scroll">
        <?php
        require_once "clsAdmin.php";
        $admin1 = new clsAdmin();
        $AllGames = $admin1->GetAvailableGames();
        foreach ($AllGames as $Game) {
          echo '<div class="image-container scroll">
                    <img src="' . $Game->Poster . '">
                    <div class="overlay">
                      <h3>' . $Game->Game_Name . '</h3>
                      <form action="" method="post">
                      <input type="hidden" name="game_id" value="' . $Game->Game_ID . '">
                      <button class="deletegame">Delete<img src="images/delete_24dp_FF7070_FILL1_wght400_GRAD0_opsz24.svg" alt=""></button>
                      </form>
                    </div>
                </div>';
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'])) {
          $gameId = $_POST['game_id'];
          $admin1->DeleteGame($gameId);
          header("Location: " . $_SERVER['PHP_SELF']);
        }
        ?>
      </div>

    </div>

    <h2>wish list</h2>

<div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
  <div class="slider-mmo scroll">
    <?php
    require_once "clsWishList.php";
    $List = new clsWishList();
    $ListGames = $List->GetAllAvailableWishGames(1, 1);
    foreach ($ListGames as $Game) {
      echo '
        <div class="image-container scroll">
      <img src="' . $Game->Poster . '">
      <div class="overlay">
        <h3>' . $Game->Game_Name . '</h3>
        <form action="" method="post">
                  <input type="hidden" name="game_id" value="' . $Game->Game_ID . '">
                  <button class="deletegame">Delete<img src="images/delete_24dp_FF7070_FILL1_wght400_GRAD0_opsz24.svg" alt=""></button>
                  </form>
          </div>
        </div>
        ';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'])) {
      $gameId = $_POST['game_id'];
      $List->RemoveGameFromWishList(1,$gameId);
       header("Location: " . $_SERVER['PHP_SELF']);
    }
    ?>

  </div>
</div>


  </main>

  <div class="users">

    <div>
      <img src="images/person_24dp_F3F3F3_FILL1_wght400_GRAD0_opsz24.svg" alt="">
      <h4>132</h4>
      <h4>Ahmed Adlaoui</h4>

      <h4>Ahmed@gmail.com</h4>
      <select name="new admin" id="">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
      </select>

    </div>

  </div>

  <script src="script.js"></script>

</body>

</html>

<?php
ob_end_flush(); 
?>
