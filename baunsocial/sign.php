<?php

require 'connect/DB.php';
require 'core/load.php';


if( isset($_POST['first-name']) && !empty($_POST['first-name'])){
$upFirst = $_POST['first-name'];
    $upLast = $_POST['last-name'];
    $upEmailMobile = $_POST['email-mobile'];
    $upPassword = $_POST['up-password'];
    $birthDay = $_POST['birth-day'];
    $birthMonth = $_POST['birth-month'];
    $birthYear = $_POST['birth-year'];
    if(!empty($_POST['gen'])){
    $upgen = $_POST['gen'];
    }
    $birth = ''.$birthYear.'-'.$birthMonth.'-'.$birthDay.'';

    if(empty($upFirst) or empty($upLast) or empty($upEmailMobile) or empty($upgen)){
        $error = 'Tüm alanları doldurman gerekiyor';
    }else{
$first_name = $loadFromUser->checkInput($upFirst);
$last_name = $loadFromUser->checkInput($upLast);
$email_mobile = $loadFromUser->checkInput($upEmailMobile);
$password = $loadFromUser->checkInput($upPassword);
$screenName = ''.$first_name.'_'.$last_name.'';
        if(DB::query('SELECT screenName FROM users WHERE screenName = :screenName', array(':screenName' => $screenName ))){
$screenRand = rand();
            $userLink = ''.$screenName.''.$screenRand.'';
        }else{
            $userLink = $screenName;
        }
if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email_mobile)){
   if(!preg_match("^[0-9]{11}^", $email_mobile)){
       $error = 'E-posta kimliği veya Cep telefonu numarası doğru değil. Lütfen tekrar deneyin.';
   }else{
     $mob = strlen((string)$email_mobile);

       if($mob > 11 || $mob < 11){
           $error = 'Cep telefonu numarası geçerli değil';
       }else if(strlen($password) <5 || strlen($password) >= 60){
           $error = 'Password is not correct';
       }else{
           if(DB::query('SELECT mobile FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))){
               $error = 'Cep telefonu numarası zaten kullanılıyor.';
           }else{
               $user_id=$loadFromUser->create('users', array('first_name'=>$first_name,'last_name'=>$last_name, 'mobile' => $email_mobile, 'password'=>password_hash($password, PASSWORD_BCRYPT),'screenName'=>$screenName,'userLink'=>$userLink, 'birthday'=>$birth, 'gender'=>$upgen));

                $loadFromUser->create('profile', array('userId'=>$user_id, 'birthday'=> $birth, 'firstName' => $first_name, 'lastName'=>$last_name, 'profilePic'=>'assets/image/defaultProfile.png','coverPic'=>'assets/image/defaultCover.png', 'gender'=>$upgen));

               $tstrong = true;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $tstrong));
          $loadFromUser->create('token', array('token'=>sha1($token), 'user_id'=>$user_id));

          setcookie('FBID', $token, time()+60*60*24*7, '/', NULL, NULL, true);

          header('Location: index.php');


           }
}
   }
}else{
  if(!filter_var($email_mobile)){
      $error = "Invalid Email Format";
  }else if(strlen($first_name) > 20 || strlen($first_name) <2){
      $error = "Name must be between 2-20 character";
  }else if(strlen($password) <5 || strlen($password) >= 60){
      $error = "The password is either too shor or too long";
  }else{
      if((filter_var($email_mobile,FILTER_VALIDATE_EMAIL)) && $loadFromUser->checkEmail($email_mobile) === true){
          $error = "Email is already in use";
      }else{

         $user_id = $loadFromUser->create('users', array('first_name'=>$first_name,'last_name'=>$last_name, 'email' => $email_mobile, 'password'=>password_hash($password, PASSWORD_BCRYPT),'screenName'=>$screenName,'userLink'=>$userLink, 'birthday'=>$birth, 'gender'=>$upgen));

          $loadFromUser->create('profile', array('userId'=>$user_id, 'birthday'=>$birth, 'firstName' => $first_name, 'lastName'=>$last_name, 'profilePic'=>'assets/image/defaultProfile.png','coverPic'=>'assets/image/defaultCover.png', 'gender'=>$upgen));


$tstrong = true;
$token = bin2hex(openssl_random_pseudo_bytes(64, $tstrong));
          $loadFromUser->create('token', array('token'=>sha1($token), 'user_id'=>$user_id));

          setcookie('FBID', $token, time()+60*60*24*7, '/', NULL, NULL, true);

          header('Location: index.php');

      }
  }
}



    }
}

if(isset($_POST['in-email-mobile']) && !empty($_POST['in-email-mobile'])){
    $email_mobile = $_POST['in-email-mobile'];
    $in_pass = $_POST['in-pass'];

    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email_mobile)){
        if(!preg_match("^[0-9]{11}^", $email_mobile)){
            $error = 'Email or Phone is not correct. Please try again';
        }else{

        if(DB::query("SELECT mobile FROM users WHERE mobile = :mobile", array(':mobile'=>$email_mobile))){
            if(password_verify($in_pass, DB::query('SELECT password FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))[0]['password'])){

                $user_id=DB::query('SELECT user_id FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))[0]['user_id'];
               $tstrong = true;
$token = bin2hex(openssl_random_pseudo_bytes(64, $tstrong));
          $loadFromUser->create('token', array('token'=>sha1($token), 'user_id'=>$user_id));

          setcookie('FBID', $token, time()+60*60*24*7, '/', NULL, NULL, true);

          header('Location: index.php');
            }else{
                $error="Password is not correct";
            }

        }else{
            $error="User hasn't found.";
        }

        }
    }else{
        if(DB::query("SELECT email FROM users WHERE email = :email", array(':email'=>$email_mobile))){
            if(password_verify($in_pass, DB::query('SELECT password FROM users WHERE email=:email', array(':email'=>$email_mobile))[0]['password'])){

                $user_id=DB::query('SELECT user_id FROM users WHERE email=:email', array(':email'=>$email_mobile))[0]['user_id'];
               $tstrong = true;
$token = bin2hex(openssl_random_pseudo_bytes(64, $tstrong));
          $loadFromUser->create('token', array('token'=>sha1($token), 'user_id'=>$user_id));

          setcookie('FBID', $token, time()+60*60*24*7, '/', NULL, NULL, true);

          header('Location: index.php');
            }else{
                $error="Password is not correct";
            }

        }else{
            $error="User hasn't found.";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BaunSocial</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="header">
        <div class="logo">BaunSocial</div>
        <form action="sign.php" method="post">
            <div class="sign-in-form">
                <div class="mobile-input">
                    <div class="input-text">Eposta ya da telefon</div>
                    <input type="text" name="in-email-mobile" id="email-mobile" class="input-text-field">
                </div>
                <div class="password-input">
                    <div style="font-size: 12px;padding-bottom: 5px;">Şifre</div>
                    <input type="password" name="in-pass" id="in-password" class="input-text-field">
                    <div class="forgotten-acc">Unutulan hesap</div>
                </div>
                <div class="login-button">
                    <input type="submit" value="Giriş Yap" class="sign-in login">
                </div>
            </div>
        </form>
    </div>

    <div class="main" style="width:100%;">
        <div class="left-side">
            <img height="300px" width="300px" src="assets/image/logo.png" alt="">
        </div>
        <div class="right-side">
            <div class="error">
                <?php if(!empty($error)){echo $error;} ?>
            </div>
            <h1 style="color:#212121;">Bir hesap oluşturun</h1>
            <div style="color:#212121; font-size:20px">Sadece Balıkesir Üniversitesi öğrecileri için</div>
            <form action="sign.php" method="post" name="user-sign-up">
                <div class="sign-up-form">
                    <div class="sign-up-name">
                        <input type="text" name="first-name" id="first-name" class="text-field" placeholder="Isim">
                        <input type="text" name="last-name" id="last-name" placeholder="Soyad" class="text-field">
                    </div>
                    <div class="sign-wrap-mobile">
                        <input type="text" name="email-mobile" id="up-email" placeholder="Cep telefonu numarası veya e-posta adresi" class="text-input">
                    </div>
                    <div class="sign-up-password">
                        <input type="password" name="up-password" id="up-password" class="text-input" placeholder="Şifre">
                    </div>
                    <div class="sign-up-birthday">
                        <div class="bday">Doğum Günü</div>
                        <div class="form-birthday">
                            <select name="birth-day" id="days" class="select-body"></select>
                            <select name="birth-month" id="months" class="select-body"></select>
                            <select name="birth-year" id="years" class="select-body"></select>

                        </div>

                    </div>
                    <div class="gender-wrap">
                        <input type="radio" name="gen" id="fem" value="female" class="m0">
                        <label for="fem" class="gender">Kadın</label>
                        <input type="radio" name="gen" id="male" value="male" class="m0">
                        <label for="male" class="gender">Erkek</label>
                    </div>
                    <div class="term">
                    Kaydol'a tıklayarak şartlarımızı, Veri politikamızı ve Çerez politikamızı kabul etmiş olursunuz. Bizden SMS bildirimleri alabilir ve istediğiniz zaman bu bildirimlerden vazgeçebilirsiniz.
                    </div>
                    <input type="submit" value="Kaydol" class="sign-up">
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>


    <script>
        for (i = new Date().getFullYear(); i > 1900; i--) {
            //    2019,2018, 2017,2016.....1901
            $("#years").append($('<option/>').val(i).html(i));

        }
        for (i = 1; i < 13; i++) {
            $('#months').append($('<option/>').val(i).html(i));
        }
        updateNumberOfDays();

        function updateNumberOfDays() {
            $('#days').html('');
            month = $('#months').val();
            year = $('#years').val();
            days = daysInMonth(month, year);
            for (i = 1; i < days + 1; i++) {
                $('#days').append($('<option/>').val(i).html(i));
            }

        }
        $('#years, #months').on('change', function() {
            updateNumberOfDays();
        })

        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();

        }

    </script>

</body>

</html>
