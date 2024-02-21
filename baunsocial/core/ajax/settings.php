<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if(isset($_POST['changeName'])){

    $userid = $_POST['changeName'];
    $firstName = $_POST['firstName'];
    $lastName= $_POST['lastName'];

    $loadFromUser->update('profile', $userid, $fields = array('firstName'=>$firstName, 'lastName'=>$lastName));
    $loadFromUser->userUpdate('users', $userid, $fields = array('first_name'=>$firstName, 'last_name'=>$lastName));

    echo '<h3 style="color:#4caf50;">Name has changed successfully.</h3>';

}
if(isset($_POST['userLink'])){

    $userLink = $_POST['userLink'];
    $userid = $_POST['userid'];
$error = '';
    if(DB::query('SELECT userLink FROM users WHERE userLink = :userLink', array(':userLink'=>$userLink))){
        $error = 'Kullanıcı Bağlantısı zaten kullanımda.';
    }else{
        $loadFromUser->userUpdate('users', $userid, $fields = array('userLink'=>$userLink));
    }


   if($error == ''){ echo '<h3 style="color:#4caf50;">Kullanıcı Bağlantısı başarıyla değiştirildi.</h3>' ; }else{echo $error; }

}
if(isset($_POST['mobileChange'])){

    $mobileChange = $_POST['mobileChange'];
    $userid = $_POST['userid'];
$error = '';



    if(DB::query('SELECT mobile FROM users WHERE mobile = :mobile', array(':mobile'=>$mobileChange))){
        $error = 'Cep telefonu numarası zaten kullanılıyor.';
    }else{

 if(!preg_match("^[0-9]{11}^", $mobileChange)){
            $error = 'Cep telefonu numarası doğru değil. Lütfen tekrar deneyin';
        }else{
$mob = strlen((string)$mobileChange);

       if($mob > 11 || $mob < 11){
           $error = 'Cep telefonu numarası geçerli değil';
       }else{
           $loadFromUser->userUpdate('users', $userid, $fields = array('mobile'=>$mobileChange));
       }

 }

    }


   if($error == ''){ echo '<h3 style="color:#4caf50;">Cep telefonu numarası başarıyla değiştirildi.</h3>' ; }else{echo $error; }

}
if(isset($_POST['emailChange'])){

    $emailChange = $_POST['emailChange'];
    $userid = $_POST['userid'];
$error = '';



    if(DB::query('SELECT email FROM users WHERE email = :email', array(':email'=>$emailChange))){
        $error = 'Email is already in use.';
    }else{

 if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$emailChange)){
            $error = 'Email is not correct. Please try again';
        }else{
           $loadFromUser->userUpdate('users', $userid, $fields = array('email'=>$emailChange));


 }

    }


   if($error == ''){ echo '<h3 style="color:#4caf50;">Email has changed successfully.</h3>' ; }else{echo $error; }

}
if(isset($_POST['oldPassword'])){

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $userid = $_POST['userid'];

$error = '';



    if(password_verify($oldPassword, DB::query('SELECT password FROM users WHERE user_id =:user_id', array(':user_id'=>$userid))[0]['password'])){

        if(strlen($newPassword) <5 || strlen($newPassword) >= 60){
           $error = 'Password is not correct';
       }else{
$loadFromUser->userUpdate('users', $userid, $fields =array('password'=>password_hash($newPassword, PASSWORD_BCRYPT)));
    }


    }


   if($error == ''){ echo '<h3 style="color:#4caf50;">Password has changed successfully.</h3>' ; }else{echo $error; }

}