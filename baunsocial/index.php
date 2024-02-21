
    <!--   ////////.........start header tob bar................//////-->
<?php include 'include/header.php'; ?>
    <!--   ////////.........end header tob bar................//////-->


    <!--   ////////.........start main area................//////-->
    <main>
        <div class="main_area" style="margin-top: 0; padding-top: 12px;">
            <!--   ////////.........start first section................//////-->

            <div class="first-section">
                <div class="active-wrap top-pic-name-wrap   ">
                    <a href="profile.php" class="top-pic-name">
                        <div class="top-pic"><img src="assets/image/icon.png" alt=""></div>
                        <div class="top-name top-css" style="color:black;">Profil</div>
                    </a>
                </div>
                <br>

                <div class="news-feed">
                    <a href="index.php" class="active-wrap-2">
                        <div class="right-nav-icon">
                            <img src="assets/image/newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Gönderiler</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="messenger.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/image/msginnews.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Mesajlar</div>
                    </a>
                </div>
            </div>
            <!--   ////////.........end first section................//////-->

            <!--   ////////.........start second section................//////-->

            <div class="second-section">
                <!--                ............ Start Status write part................-->
<?php include 'include/status.php'; ?>
                <!--                ............ end Status write part................-->

                <!--                ............ Start timeline part................-->

                <div class="news-feed-comp">
               <?php $loadFromPost->homePosts($userid, $profileId, 20) ?>

                </div>
                <div class="loader-wrap align-middle " style="width: 100%;">

                </div>
                <!--                ............ end timeline................-->
            </div>
            <div class="third-section">
                
                <div class="birthday-wrap">
                    <a href="" class="birthday-gift">
                        <div class="birth-img">
                            <img src="assets/image/birthdayGift.JPG" alt="">
                        </div>
                        <div class="birth-name-wrap"><span class="birth-name"></span><span class="birth-date">bugün doğum günü </span></div>
                    </a>
                </div>
                
            </div>
        </div>
        <div class="top-box-show"></div>
            <div id="adv_dem"></div>

    </main>

 <script src="assets/js/jquery.js "></script>
        <script src="assets/dist/emojionearea.min.js"></script>
        <script src="assets/js/main.js"></script>
</body>

</html>
