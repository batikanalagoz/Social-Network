<?php

include '../load.php';
include '../../connect/login.php';


$user_id = login::isLoggedIn();

if(isset($_POST['submitType'])){
    $submitType = $_POST['submitType'];
    $inputVal = $_POST['inputVal'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->update('profile', $userid, array($submitType => $inputVal));
    echo $inputVal;
}



    if(isset($_POST['overview'])){
    $userid = $_POST['overview'];
    $profileid = $_POST['profileid'];

    $userData= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap" style="flex-basis:70%; ">
    <div class="overview-left">
        <div class="about-work-heading">İŞ</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileid, 'İş yeri ekle'); ?>

        <div class="about-work-heading">OKUL</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileid, 'Lise ekle'); ?>
        <div class="about-work-heading">YER</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('address', $userid, $profileid, 'Mevcut yerinizi ekleyin'); ?>
        <div class="about-work-heading">İLİŞKİ</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('relationship', $userid, $profileid, 'İlişki durumunuzu ekleyin'); ?>

    </div>
    <div class="overview-right" style="flex-basis:30%;">
        <a href="setting.php" class="overview-right">
            <div class="overview-mobile align-middle" style="margin-bottom:10px;">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->mobile; ?></div>
            </div>
            <div class="overview-birthday align-middle">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->birthday; ?></div>
            </div>
        </a>

    </div>
</div>


<?php
}if(isset($_POST['workEducation'])){
    $userid = $_POST['workEducation'];
    $profileid = $_POST['profileid'];

    $userdata= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap">
    <div class="overview-left">
        <div class="about-work-heading">İŞ</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileid, 'İş yeri ekle'); ?>

        <div class="about-work-heading">BECERILER</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('professional', $userid, $profileid, 'Profesyonel becerilerinizi ekleyin'); ?>
        <div class="about-work-heading">LISE</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('college', $userid, $profileid, 'Lise ekle'); ?>
        <div class="about-work-heading">UNIVERSITE</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileid, 'Üniversite ekle'); ?>
    </div>
</div>


<?php
}if(isset($_POST['placesLived'])){
    $userid = $_POST['placesLived'];
    $profileid = $_POST['profileid'];

    $userdata= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap">
    <div class="overview-left">
        <div class="about-work-heading">ŞU ANKİ ŞEHİR</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('currentCity', $userid, $profileid, 'Yaşadığınız şehri ekleyin'); ?>

        <div class="about-work-heading">MEMLEKET</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('hometown', $userid, $profileid, 'Memleket ekle'); ?>
        <div class="about-work-heading">YAŞANAN DİĞER YERLER</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('otherPlace', $userid, $profileid, 'Başka yer ekle'); ?>
    </div>
</div>


<?php
}
if(isset($_POST['contactBasic'])){
    $userid = $_POST['contactBasic'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">TEMEL BİLGİ</div>
        <div class="about-border"></div>
        <div class="contact-mobile" style="width: 100%;display:flex; ">
            <div class="contact-mobile-text setting" style="flex-basis:40%">Cep telefonu</div>
            <div class="contact-mobile-number setting" style="flex-basis:60%"><?php echo $userdata->mobile;?></div>
        </div>
        <div class="about-border"></div>
        <div class="contact-id" style="width: 100%;display:flex; ">
            <div class="contact-id-text setting" style="flex-basis:40%">BaunSocial</div>
            <div class="contact-id-number setting" style="flex-basis:60%"><?php echo $userdata->userLink;?></div>
        </div>
        <br><br>
        <div class="about-work-heading">Adres</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('address', $user_id, $profileid, 'Adresinizi ekleyin' );   ?>
        <div class="about-work-heading">WEB SİTESİ VE SOSYAL BAĞLANTILAR</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('website', $user_id, $profileid, 'Web sitenizi ekleyin' );   ?>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('socialLink', $user_id, $profileid, 'Sosyal bağlantınızı ekleyin' );?>
        <div class="about-work-heading">TEMEL BİLGİLER</div>
        <div class="about-border"></div>
        <div class="contact-birthday setting" style="width: 100%;display:flex; ">
            <div class="contact-birthday-text" style="flex-basis:40%;font-size: 13px;color: gray;">Doğum günü</div>
            <div class="contact-birthday-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userdata->birthday;?></div>
        </div>
        <div class="about-border "></div>
        <div class="contact-birthyear setting" style="width: 100%;display:flex; ">
            <div class="contact-birthyear-text" style="flex-basis:40%;font-size: 13px;color: gray;">Doğum Yılı</div>
            <div class="contact-birthyear-date" style="flex-basis:60%;font-size: 13px;color: black;">1990</div>
        </div>
        <div class="about-border "></div>
        <div class="contact-gender setting" style="width: 100%;display:flex; ">
            <div class="contact-gender-text" style="flex-basis:40%;font-size: 13px;color: gray;">Cinsiyet</div>
            <div class="contact-gender-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userdata->gender;?></div>
        </div>
        <br>
        <div class="about-work-heading">DİLLER</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('language', $user_id, $profileid, 'Dilinizi ekleyin' );?>
        <br>
    </div>
</div>
<?php
}
if(isset($_POST['familyRelation'])){
    $userid = $_POST['familyRelation'];
    $profileid = $_POST['profileid'];
  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">İLİŞKİ</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverview('relationship', $user_id, $profileid, 'İlişki durumunuzu ekleyin' );?>
    </div>
</div>
<?php
}
if(isset($_POST['aboutYou'])){
    $userid = $_POST['aboutYou'];
    $profileid = $_POST['profileid'];
  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">SENİN HAKKINDA</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('aboutYou', $user_id, $profileid, 'Senin hakkında yazı yaz' );?><br>
        <div class="about-work-heading"> DİĞER İSİMLER</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('otherName', $user_id, $profileid, 'Diğer adınızı ekleyin' );?>
        <br>
        <div class="about-border"></div>
    </div>
</div>
<?php
}
if(isset($_POST['lifeEvent'])){
    $userid = $_POST['lifeEvent'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>

<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">YAŞAM OLAYLARI</div>
        <div class="about-border"></div>
        <div class="contact-add-life-event" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; ">
            <?php  $loadFromPost->aboutOverviewAlt('lifeEvent', $user_id, $profileid, 'Yaşam olayı ekle' );?>
        </div>
    </div>
</div>


<?php

}



?>
