<?php
require_once 'dbconn.php';
require 'game.php';
$games = game::fetchallgames();
session_start();

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
  public static function fetchlibrarygames()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();



    $stmt = $connection->prepare("SELECT * FROM Libraries WHERE User_ID = :userid");
    $stmt->bindParam('userid', $_SESSION['user_ID']);
    $stmt->execute();
    $currentlib = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT * FROM library_join WHERE Library_ID = :libid  ");
    $stmt->bindParam(':libid', $currentlib['Library_ID']);
    $stmt->execute();
    $librarygamesID = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $gameIDs = array_column($librarygamesID, 'Game_ID');
    $placeholders = implode(',', array_fill(0, count($gameIDs), '?'));
    $stmt = $connection->prepare("SELECT * FROM Games WHERE Game_ID IN ($placeholders)");
    $stmt->execute($gameIDs);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

$library_games = User::fetchlibrarygames();

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
  <script src="https://cdn.tailwindcss.com"></script>
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
          <input type="password" name="new-password" id="confirme-password" placeholder="New password" required>
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
        foreach ($games  as $game):
          echo '<div class="image-container scroll">
                    <img src="' . $game['Poster'] . '" alt="">
                    <div class="overlay">
                        <h3>' . $game['Game_Name'] . '</h3>
                        <form action="" method="post">
                            <button class="deletegame">Delete<img src="images/delete_24dp_FF7070_FILL1_wght400_GRAD0_opsz24.svg" alt=""></button>
                        </form>
                    </div>
                </div>';

        ?>

        <?php endforeach; ?>
      </div>

    </div>
  </main>

  <main class="title-info">
    <h2>My library</h2>

    <div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
      <div class="slider-mmo scroll">

        <?php
        foreach ($library_games  as $library_game):
          echo '<div class="image-container scroll">
                    <img src="' . $library_game['Poster'] . '" alt="">
                    <div class="overlay">
                        <h3>' . $library_game['Game_Name'] . '</h3>
                    </div>
                </div>';

        ?>

        <?php endforeach; ?>
      </div>

    </div>
  </main>

  <div class="font-[sans-serif] overflow-x-auto">
    <table class="w-[90%] bg-white mx-auto">
      <thead class="bg-gray-800 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left text-sm font-medium text-white">
            User_ID
          </th>
          <th class="p-4 text-left text-sm font-medium text-white">
            Email
          </th>
          <th class="p-4 text-left text-sm font-medium text-white">
            Nickname
          </th>
          <th class="p-4 text-left text-sm font-medium text-white">
            Role
          </th>
          <th class="p-4 text-left text-sm font-medium text-white">
            Actions
          </th>
        </tr>
      </thead>

      <tbody class="whitespace-nowrap">


        <?php
        // Assuming $users is an array of user data
        foreach ($users as $user) {
        ?>
          <tr class="even:bg-blue-50">
            <td class="p-4 text-sm text-black">
              <?php echo htmlspecialchars($user['User_ID']); ?>
            </td>
            <td class="p-4 text-sm text-black">
              <?php echo htmlspecialchars($user['Email']); ?>
            </td>
            <td class="p-4 text-sm text-black">
              <?php echo htmlspecialchars($user['Nick_Name']); ?>
            </td>
            <td class="p-4 text-sm text-black">
              <?php echo htmlspecialchars($user['Role']); ?>
            </td>
            <td class="p-4">
              <button class="mr-4" title="Ban">
                <img src="images/block_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt="">
              </button>
            </td>
          </tr>
        <?php
        }
        ?>


      </tbody>
    </table>
  </div>
  <script src="script.js"></script>

</body>

</html>