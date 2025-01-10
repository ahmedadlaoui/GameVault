<?php
session_start();

require 'User.php';
require 'game.php';

$library_games = User::fetchlibrarygames();

$user_infos = User::fetchuser_infos();
$users = User::fetchallusers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['savechanges'])) {
  user::edit_uuserinfos();
}

if (!empty($_SESSION['user_ID']) && isset($_GET['User_ID'])) {
  User::BanUser($_GET['User_ID']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user profile</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="user_dashboard.css?<?php echo time() ?>">
</head>

<body>
<div class="fakeheader"></div>


<header>
    <ul>
        <a href=""><img src="images/logogm-removebg-preview.png" alt="logo" id="logo"></a>
        <a href="">
            <li>ABOUT US</li>
        </a>
        <a href="" style="display: flex;">
            <li>CONTACT</li>
        </a>
        <?php
            if( isset($_SESSION['Role']) &&$_SESSION['Role'] === 'Admin'){
                echo '            <a href="dashboard.php" style="display: flex;">
            <li>Dashboard</li><img src="images/headset_mic_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg" alt="">
        </a>';
            }
        ?>
    </ul>
    <a style="text-decoration: none;" href="sign-in.php"><button name="log" class="log"><img class="profile" src="<?php if(isset($_SESSION['Nickname'])){echo  $_SESSION['Profile_Pic'];} else{echo 'images/person_24dp_F3F3F3_FILL1_wght400_GRAD0_opsz24.svg';} ?>" alt=""><?php if(isset($_SESSION['Nickname'])){ echo'Log Out';}else{echo'Log In';} ?></button></a>
</header>

<?php
if (!empty($_SESSION['Nickname'])) {
    echo '<div class="sub-header" id="header">
    <ul>
        <a href="index.php">
            <li>Home</li>
        </a>
        <a href="">
            <li>Historic</li>
        </a>
        <a href="">
            <li>Feedbacks</li>
        </a>
    </ul>
    <form style="position: relative;">
        <button id="search"><img src="images/search_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg"></button>
        <input type="text" placeholder="Search for games">
    </form>
    <a href="user_dashboard.php" id="Wishlist">View Profile</a>
</div>';
}


?>

  <section class="relative block h-500-px">
    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('https://e1.pxfuel.com/desktop-wallpaper/230/999/desktop-wallpaper-gamer-banners-gamer-banner.jpg');
          ">
      <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section style="background-color: black" class="relative py-16 bg-[rgba(223, 223, 223, 0.47)]-200">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6" style="background-color:rgb(18, 18, 18);padding-bottom:24px;">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img alt="..." src="<?php echo  $user_infos['Profile_Pic'] ?>" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">

              </div>

            </div>

            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
                <button id="edit" class="bg-orange-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                  Edit infos
                </button>
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span style=" color: #ffffff;" class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span style=" color: #ffffff;" class="text-sm text-blueGray-400">Friends</span>
                </div>
                <div class="mr-4 p-3 text-center">
                  <span style=" color: #ffffff;" class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">8</span><span style=" color: #ffffff;" class="text-sm text-blueGray-400">Games</span>
                </div>
                <div class="lg:mr-4 p-3 text-center">
                  <span style=" color: #ffffff;" class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span style=" color: #ffffff;" class="text-sm text-blueGray-400">Messages</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h4 style="margin-top:-28px;color:rgb(185, 185, 185);" class="text-1xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2"><?php echo  $user_infos['Email'] ?></h4>
            <h3 style=" color: #ffffff" class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
              <?php echo  $user_infos['Nick_Name'] ?>
            </h3>

          </div>

          <div class="data-info">

            <div class="box">
              <i class="fas fa-coins"></i>
              <div class="data">
                <p>Total score</p>
                <span>180</span>
              </div>
            </div>



            <div class="box">
              <i class="fas fa-user-group"></i>
              <div class="data">
                <p>friends</p>
                <span>380</span>
              </div>
            </div>






          </div>

          <div class="content" id="edit-form">
            <div class="changeifos">
              <div style="background-image: url(<?php echo  $user_infos['Profile_Pic'] ?>);background-size:cover;background-repeat:norepeat;">


              </div>

              <form action="user_dashboard.php" method="POST">
                <div>
                  <label for="user-name"><span>name</span></label>
                  <input type="text" name="name" id="user-name" value="<?php echo  $user_infos['Nick_Name'] ?>">
                </div>
                <div>
                  <label for="user-email"><span>email</span></label>
                  <input type="email" name="email" id="user-email" value="<?php echo  $user_infos['Email'] ?>">
                </div>


                <div>
                  <label for="new-password"><span>Profile picture</span></label>
                  <input type="text" name="new-profile_pic" id="new-profile_pic" VALUE="<?php echo  $user_infos['Profile_Pic'] ?>" required>
                </div>



                <div>
                  <label for="confirme-password"><span>Password</span></label>
                  <input type="password" name="new-password" id="confirme-password" placeholder="New password" value="<?php echo base64_decode($user_infos['Password']) ?>" required>
                </div>


                <button type="submit" name="savechanges">save changes</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

  </section>

  <main class="title-info">
    <h2>My library</h2>

    <div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
      <div class="slider-mmo scroll">

        <?php
        if ($library_games) {
          foreach ($library_games  as $library_game):
            echo '<div class="image-container scroll">
                      <img src="' . $library_game['Poster'] . '" alt="">
                      <div class="overlay">
                          <a href="gamepage.php?Game_ID=' . $library_game['Game_ID'] . '"><h3>' . $library_game['Game_Name'] . '</h3></a>
                      </div>
                  </div>';
          endforeach;
        }
        ?>

      </div>

    </div>
  </main>

  <script src="script.js"></script>
  <script>
     document.getElementById('edit-form').style.display = "none"
    document.getElementById('edit').addEventListener('click', () => {
      if(document.getElementById('edit-form').style.display === "none"){
        document.getElementById('edit-form').style.display = "block"
      }else{
        document.getElementById('edit-form').style.display = "none"
      }
    })

  </script>

</body>

</html>