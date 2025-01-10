    <?php
    session_start();
    if(!isset($_SESSION['user_ID'])){
        exit;
    }

    require 'game.php';
    require 'User.php';

    $current_game = game::fetchGamebyid($_GET['Game_ID']);

    $currentchat = game::fetchgamemessages($_GET['Game_ID']);
    $gamescreens = game::fetchgamescreens($_GET['Game_ID']);
    $URLS =array_column($gamescreens,'Screen_Url');


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Send-msg'])) {
        game::Insertgamemessage($_GET['Game_ID'], $_SESSION['user_ID'], $_POST['message-content'], $_SESSION['Nickname'], $_SESSION['Profile_Pic']);
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css?<?php echo time() ?>">
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
        <div class="hero">
            <img src="<?php echo $URLS[4] ?>" class="principale">
        </div>
        <div class="z3antot">
            <button id="forwardd"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>
            <button id="backwardd"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>
            <div class="sliderr">
                <img src="<?php echo $URLS[1] ?>" class="small">
                <img src="<?php echo $URLS[2] ?>" class="small">
                <img src="<?php echo $URLS[3] ?>" class="small">
                <img src="<?php echo $URLS[4] ?>" class="small">
                <img src="<?php echo $URLS[5] ?>" class="small">
            </div>
        </div>

        


        <div class="main-sec">


            <div class="current_infos">
                <img src="<?php echo $current_game['Poster'] ?>" alt="">
                <h1><?php echo $current_game['Game_Name'] ?></h1>
                <h2>Category : <?php echo $current_game['Game_Category'] ?></h2>
                <h2>Release date : <?php echo $current_game['Relese_Date'] ?></h2>
                <button id="watchgameplay">Gameplay <img src="images/smart_display_24dp_E8EAED_FILL1_wght400_GRAD0_opsz24.svg" alt=""></button>
           
            </div>
            <div class="chat">
<div class="messages">
                <?php
                foreach ($currentchat as $msg) {
                    if ($msg['Nick_Name'] == $_SESSION['Nickname']) {
                        echo '<div class="rt mine flex items-start gap-2.5">
                        <img class="w-8 h-8 rounded-full" src="' . $msg['user_profile'] . '" alt="Jese image">
                        <div class="flex flex-col gap-1 w-full max-w-[320px]">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">' . $msg['Nick_Name'] . '</span>
                                <span class="ss text-sm font-normal text-gray-500 dark:text-gray-400">' . $msg['message_date'] . '</span>
                            </div>
                            <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 dark:bg-[rgb(75,75,75)] rounded-e-xl rounded-es-xl">
                                <p class="text-sm font-normal text-gray-900 dark:text-white">' . $msg['Message_Content'] . '</p>
                            </div>
                        </div>
                    </div>';
                    } else {
                        echo '
                        <div class="rt flex items-start gap-2.5">
                            <img class="w-8 h-8 rounded-full" src="' . $msg['user_profile'] . '" alt="Jese image">
                            <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">' . $msg['Nick_Name'] . '</span>
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">' . $msg['message_date'] . '</span>
                                </div>
                                <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 dark:bg-[rgb(35,35,35)] rounded-e-xl rounded-es-xl">
                                    <p class="text-sm font-normal text-gray-900 dark:text-white">' . $msg['Message_Content'] . '</p>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
                </div>






                <form class="relative flex items-center gap-2" id="cvh" method="POST" action="gamepage.php?Game_ID=<?php echo $_GET['Game_ID']  ?>">

                    <input
                        name="message-content"
                        type="text"
                        placeholder="Type your message..."
                        class="w-full p-3 pl-4 pr-16 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[rgb(75,75,75)] text-gray-900 dark:text-white focus:outline-none" />

                    <button name="Send-msg"
                        class="absolute right-2 p-2 rounded-lg bg-[rgb(75,75,75)]-500 text-white hover:bg-[rgb(35,35,35)] focus:outline-none">
                        Send
                    </button>
                </form>


            </div>

        </div>



        <script src="gamepagescript.js"></script>
    </body>

    </html>