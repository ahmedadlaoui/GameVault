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
                <a href=""><li>PREMIUM</li></a>
                <a href="" style="display: flex;"><li>DOWLOAD</li> <img src="images/download_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg" alt=""></a>
                <a href="" style="display: flex;"><li>Dashboard</li><img src="images/headset_mic_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg" alt=""></a>
            </ul>
            <button><img src="images/person_24dp_F3F3F3_FILL1_wght400_GRAD0_opsz24.svg" alt="">Log In</button>
        </header>
    
        <div class="sub-header" id="header">
            <ul>
                <a href=""><li>Home</li></a>
                <a href=""><li>Collection</li></a>
                <a href=""><li>Feedbacks</li></a>
            </ul>
            <form style="position: relative;">
                <button id="search"><img src="images/search_24dp_F3F3F3_FILL0_wght500_GRAD0_opsz24.svg"></button>
                <input type="text" placeholder="Search for games">
            </form>
            <a href="" id="Wishlist">View Profile</a>
        </div>

        <div class="hero">
            <img src="images/detailsp.webp" class="principale">
            <div class="z3antot">
                <img src="images/detail.jpg" class="small">
                <img src="images/detail1.jpg" class="small">
                <img src="images/detail2.jpg" class="small">
                <img src="images/detail3.jpg" class="small">
            </div>
        </div>
        

        <div class="forum">
            <div class="message">
            </div>
        </div>


        <script src="script.js"></script>
    </body>
    </html>