<?php
session_start();
// session_destroy();
require 'game.php';
$games = game::fetchallgames();


require_once 'dbconn.php';

class library{
    private $user_ID;
    private $game_ID;

    public function __construct($user_ID,$game_ID)
    {
        $this->user_ID = $user_ID;
        $this->game_ID = $game_ID;
    }

    public static function addtolibrary($user_ID,$game_ID){

        $dbconnection = dbconnection::Getinstanse();
        $connection = $dbconnection->getconnection();

        $stmt = $connection->prepare("SELECT * FROM Libraries WHERE User_ID = :userid");
        $stmt->bindParam('userid',$user_ID);
        $stmt->execute();
        $currentlib = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $connection->prepare("INSERT INTO library_join (Game_ID, Library_ID) VALUES (:gameid, :libid)");
            $stmt->bindParam(':gameid', $game_ID);
            $stmt->bindParam(':libid', $currentlib['Library_ID']);
            $stmt->execute();
        header('location: index.php');
        exit();
    }
}

if (!empty($_SESSION['user_ID']) && isset($_GET['Game_ID'])) {
    library::addtolibrary($_SESSION['user_ID'], $_GET['Game_ID']);
    exit();
} 

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




    <section>
    <h1 class="hed">Welcome to GameVault – Your Ultimate Gaming Hub</h1>
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
                foreach ($games as $game):
                    if ($game['Game_Category'] === 'MMO RPG') {
                        echo '<div class="image-container scroll">
            <img src="' . $game['Poster'] . '" alt="">
            <div class="overlay">
                <h3>' . $game['Game_Name'] . '</h3>
                <button class="addtolib" data-game-id="' . $game['Game_ID'] . '">
                    <img src="images/library_add_24dp_F19E39_FILL0_wght400_GRAD0_opsz24.svg" alt="">
                    <p class="txt">Add to library</p>
                </button>
            </div>
        </div>';
                    }
                endforeach;
                ?>


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
                foreach ($games as $game):
                    if ($game['Game_Category'] === 'FPS') {
                        echo '<div class="image-container scroll">
            <img src="' . $game['Poster'] . '" alt="">
            <div class="overlay">
                <h3>' . $game['Game_Name'] . '</h3>
                <button class="addtolib" data-game-id="' . $game['Game_ID'] . '">
                    <img src="images/library_add_24dp_F19E39_FILL0_wght400_GRAD0_opsz24.svg" alt="">
                    <p class="txt">Add to library</p>
                </button>
            </div>
        </div>';
                    }
                endforeach;
                ?>
        </div>
        <h2 class="scroll">Battleground games</h2>
        <div class="slider-btl">

        <?php
                foreach ($games as $game):
                    if ($game['Game_Category'] === 'Battleground') {
                        echo '<div class="image-container scroll">
            <img src="' . $game['Poster'] . '" alt="">
            <div class="overlay">
                <h3>' . $game['Game_Name'] . '</h3>
                <button class="addtolib" data-game-id="' . $game['Game_ID'] . '">
                    <img src="images/library_add_24dp_F19E39_FILL0_wght400_GRAD0_opsz24.svg" alt="">
                    <p class="txt">Add to library</p>
                </button>
            </div>
        </div>';
                    }
                endforeach;
                ?>
        </div>
    </main>


    <script src="script.js"></script>
</body>

</html>