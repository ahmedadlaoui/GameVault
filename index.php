<?php
    session_start();
    require 'game.php';
    $games = game::fetchallgames();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault_home</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">

</head>

<body>
    <div class="fakeheader"></div>


    <header>
        <ul>
            <a href=""><img src="images/logogm-removebg-preview.png" alt="logo" id="logo"></a>
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
    if (!empty($_SESSION['Nickname'])) {
        echo '<div class="sub-header" id="header">
        <ul>
            <a href="">
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
        <a href="user_dashboard.php" id="Wishlist">View Profile</a>
    </div>';
    }


    ?>




    <section>
        <img src="images/pxfuel (2).jpg" alt="">
        <button>Get Started</button>
    </section>

    <main>

        <h2 class="">MMO & MMORPG games</h2>
        <div style="position: relative;width: 100%;display: flex;justify-content: flex-end;align-items: center;">
            <button id="forward"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>
            <button id="backward"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>


            <div class="slider-mmo scroll">

            <?php
                foreach($games  as $game):
                    if($game['Game_Category'] === 'MMO RPG'){
                        echo '<div class="image-container scroll">
                    <img src="'.$game['Poster'].'" alt="">
                    <div class="overlay">
                        <h3>'.$game['Game_Name'].'</h3>
                    </div>
                </div>';
                    }
                    ?>

            <?php endforeach; ?>
            </div>

        </div>

        <div class="space ">
            <!-- <h1>Assassin creed seies</h1> -->
            <img src="images/assassincrd.jpg" id="background">
            <div class="small-slider">
                <div class="ss-container scroll">
                    <img src="images/origin.png" class="aside">
                    <div class="overlay">
                    </div>
                </div>
                <div class="ss-container scroll">
                    <img src="images/valhalla.jpg" class="aside">
                    <div class="overlay">
                    </div>
                </div>
                <div class="ss-container scroll">
                    <img src="images/odyssey.jpg" class="aside">
                    <div class="overlay"></div>
                </div>
                <div class="ss-container scroll">
                    <img src="images/syndicate.jpg" class="aside">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>

        <h2 class="scroll">FPS games</h2>
        <div class="slider-fps">
        <?php
                foreach($games  as $game):
                    if($game['Game_Category'] === 'FPS'){
                        echo '<div class="image-container scroll">
                    <img src="'.$game['Poster'].'" alt="">
                    <div class="overlay">
                        <h3>'.$game['Game_Name'].'</h3>
                    </div>
                </div>';
                    }
                    ?>

            <?php endforeach; ?>
        </div>

        <h2 class="scroll">Battleground games</h2>
        <div class="slider-btl">

        <?php
                foreach($games  as $game):
                    if($game['Game_Category'] === 'Battleground'){
                        echo '<div class="image-container scroll">
                    <img src="'.$game['Poster'].'" alt="">
                    <div class="overlay">
                        <h3>'.$game['Game_Name'].'</h3>
                    </div>
                </div>';
                    }
                    ?>
            <?php endforeach; ?>
        </div>
    </main>


    <script src="script.js"></script>
</body>

</html>