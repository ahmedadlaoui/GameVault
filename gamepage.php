    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
            <button><img src="images/person_24dp_F3F3F3_FILL1_wght400_GRAD0_opsz24.svg" alt="">Log In</button>
        </header>

        <div class="sub-header" id="header">
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
        </div>

        <div class="hero">
            <img src="images/detailsp.webp" class="principale">
        </div>
        <div class="z3antot">
            <button id="forwardd"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>
            <button id="backwardd"><img src="images/arrow_forward_ios_24dp_F19E39_FILL0_wght700_GRAD200_opsz24.svg" alt=""></button>
            <div class="sliderr">
                <img src="images/detail.jpg" class="small">
                <img src="images/detail1.jpg" class="small">
                <img src="images/detail2.jpg" class="small">
                <img src="images/detail3.jpg" class="small">
                <img src="https://store.ubisoft.com/dw/image/v2/ABBS_PRD/on/demandware.static/-/Sites-masterCatalog/default/dwc9fdc486/images/large/660e5a03fbff4e2940488bcd-4.jpg?sw=500&sh=270&sm=fit" class="small">
            </div>
        </div>


        <div class="forum">
            <div class="message">
            </div>
        </div>


        <script src="script.js"></script>
    </body>

    </html>