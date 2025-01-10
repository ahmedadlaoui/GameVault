<?php
session_start();
if( isset($_SESSION['Role']) && $_SESSION['Role'] === 'User'){
    exit;
}
require 'game.php';
require 'User.php';


$games = game::fetchallgames();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addgame'])) {

    $gameinstance = new game(NULL, null, null, null);
    $gameExists = false;
    foreach ($games as $game) {
        if ($game['Game_Name'] === $_POST['game-name']) {
            $gameExists = true;
            break;
        }
    }
    if (!$gameExists) {
        $gameinstance = new game(NULL, null, null, null);
        $gameinstance->addNewGame($_POST['game-name'], $_POST['poster'], $_POST['game-category'], $_POST['release-date']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-screen'])){
        game::addscreen($_POST['game_ID'],$_POST['screenshot1']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_dashboard.css?<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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





    <main class="title-info">
        <h2>All available games :</h2>

        <div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
            <div class="slider-mmo scroll">

                <?php
                foreach ($games as $game):
                    echo '<div class="image-container scroll">
                    <img src="' . $game['Poster'] . '" alt="">
                    <div class="overlay">
                        <h3>' . $game['Game_Name'] . '</h3>
                        <form action="dashboard.php" method="post">
                <a href="dashboard.php?Game_ID=' . $game['Game_ID'] . '">  <button name="deletegame" class="deletegame">Delete<img src="images/delete_24dp_FF7070_FILL1_wght400_GRAD0_opsz24.svg" alt=""></button></a>
                </form>
                    </div>
                </div>';

                endforeach;

                ?>
            </div>
        </div>
    </main>


    <div id="vb" style="width: 100%;">
    <form action="dashboard.php" class="add-game" method="POST">
        <!-- <h2>add new game</h2> -->
            <h2>Add new game</h2>
            <input class="inputt" type="text" name="game-name" id="game-name" placeholder="Game Name" value="" required>
            <input class="inputt" type="text" name="poster" id="poster" placeholder="Poster path" required>
            <input class="inputt" type="text" name="game-category" id="game-category" placeholder="Game category" value="" required>
            <input class="inputt" type="date" name="release-date" id="release-date" required>
        <button class="add" name="addgame">Add Game</button>
    </form>


    <form class="screen-shots" method="POST" action="dashboard.php">
        <h2>Add Screen</h2>
        <select class="selectt" name="game_ID" required>
            <option value="" disabled selected>Select Game</option>
            <?php
            foreach ($games as $game):
                echo '<option value="' . $game['Game_ID'] . '">' . $game['Game_Name'] . '</option>';
            endforeach;
            ?>
        </select>
        <!-- <input class="inputt" type="text" name="main-screen" placeholder="Banner path"> -->
        <input class="inputt" type="text" name="screenshot1" placeholder="Screenshot path" required>
        <button class="savebtn" name="save-screen">Save</button>
    </form>
    </div>











    <div class="font-[sans-serif] overflow-x-auto">
        <h2 class="alls">All users :</h2>
        <table class="w-[92%] bg-white mx-auto">
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
                foreach ($users as $user) {
                ?>
                    <tr class="even:bg-blue-50">
                        <td class="p-4 text-sm text-black">
                            <?php echo $user['User_ID']; ?>
                        </td>
                        <td class="p-4 text-sm text-black">
                            <?php echo $user['Email']; ?>
                        </td>
                        <td class="p-4 text-sm text-black">
                            <?php echo $user['Nick_Name']; ?>
                        </td>
                        <td class="p-4 text-sm text-black">
                            <?php echo $user['Role']; ?>
                        </td>
                        <td class="p-4">
                            <button class="mr-4" title="Ban" style="display: flex;color:red;column-gap:4px;" bann_player_ID="<?php echo $user['User_ID']; ?>">
                                <img src="images/block_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg" alt=""> Ban
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