<?php

// include 'sign-in.php';
session_start();

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
    if (!empty($_SESSION['Nickname'])) {
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
                    <input type="text" name="name" id="user-name" value="mohamed">
                </div>
                <div>
                    <label for="user-email"><span>email</span></label>
                    <input type="email" name="email" id="user-email" value="email@email.com">
                </div>


                <div>
                    <label for="new-password"><span>New password</span></label>
                    <input type="password" name="new-password" id="new-password" placeholder="new password" required>
                </div>



                <div>
                    <label for="confirme-password"><span>Confirme password</span></label>
                    <input type="password" name="confirme-password" id="confirme-password" placeholder="confirm password" required>
                </div>


                <button type="submit">save changes</button>
            </form>
        </div>


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




    </div>

    <script src="script.js"></script>

</body>

</html>