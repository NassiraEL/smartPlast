<?php
$total = [];
try{
    include_once '../connection.php';

    //count le nombre des admins
    $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_ADMIN` FROM `admin`");
    $stm->execute();
    $result = $stm->fetch();
    $total['TOTAL_ADMIN'] = $result['TOTAL_ADMIN'];

    //count le nombre des collectors
    $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_COLLECTOR` FROM `collector`");
    $stm->execute();
    $result = $stm->fetch();
    $total['TOTAL_COLLECTOR'] = $result['TOTAL_COLLECTOR'];


     //count le nombre des partners
     $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_PARTNER` FROM `partner`");
     $stm->execute();
     $result = $stm->fetch();
     $total['TOTAL_PARTNER'] = $result['TOTAL_PARTNER'];

     //count le nombre des COMMANDS
     $stm = $db->prepare("SELECT COUNT(*) AS `TOTAL_COMMAND` FROM `command`");
     $stm->execute();
     $result = $stm->fetch();
     $total['TOTAL_COMMAND'] = $result['TOTAL_COMMAND'];



    echo json_encode($total);
}catch(PDOException $e){
    echo $e->getMessage();
}

?>