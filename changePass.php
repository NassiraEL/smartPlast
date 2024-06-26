<?php

session_start();
$email = $_POST["email"];
$who_forgot = $_POST["who_forgot"];
$who = strtoupper($who_forgot);

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(!empty($_POST['pass'])  && !empty($_POST['passConf'])){
    $pass = validate($_POST["pass"]);
    $passConf = validate($_POST["passConf"]);

    if(strlen($pass) < 8){
        echo "يجب أن تكون كلمة المرور أطول من 8 أحرف";
    }else if($pass !=  $passConf){
        echo "كلمات المرور غير متطابقة";
    }else{
        try{
            include_once 'connection.php';

            $hashedData = hash('sha3-256', $pass);

            $stm = $db->prepare("UPDATE $who_forgot SET `{$who}_PASSWORD`=:password WHERE `{$who}_EMAIL` = :email");
            $stm->bindParam(":password", $hashedData);
            $stm->bindParam(":email", $email);
            $stm->execute();
            echo "true";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}else{
    echo "يرجى ملء جميع الحقول";
}
?>