<?php session_start(); ?>

<?php
include('db.php');
?>


<?php

try {

    $data1['email'] = $_SESSION['semail'];


    $sqlQuery = "SELECT id FROM otium where email = :email";

    $kysely1 = $DBH->prepare($sqlQuery);
    $kysely1->execute($data1);
    $tulos1 = $kysely1->fetch();
    $currentUserID = $tulos1[0];

    $data3['userID'] = $currentUserID;
    $sql3 = "DELETE  FROM tbl_events WHERE userID = :userID";

    $kysely3 = $DBH->prepare($sql3);
    $kysely3->execute($data3);

    $step = $DBH->prepare("DELETE FROM otium WHERE email=:email");
    
    $step->execute($data1);
    session_unset();
    session_destroy();
    header("Location: index.php");

} catch (PDOException $e) {
    echo "Yhteysvirhe: " . $e->getMessage();
    file_put_contents('log/DBErrors.txt', 'Connection rivi 19: ' . $step . "\n", FILE_APPEND);
}


?>