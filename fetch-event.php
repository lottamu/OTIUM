<?php session_start(); ?>

<?php
require_once "db.php";
file_put_contents('log/DBErrors.txt', 'Connection: '.'rivi5'."\n", FILE_APPEND);
$json = array();

file_put_contents('log/DBErrors.txt', 'Connection rivi8: '.$_SESSION['semail']."\n", FILE_APPEND);



try {
    // hae käyttäjän ID sähköpostiin avulla käyttäjä taulusta
$data1['email'] = $_SESSION['semail']; 
$sqlQuery = "SELECT id FROM otium where email = :email";

file_put_contents('log/DBErrors.txt', 'Connection: '.'rivi8'.$sqlQuery."\n", FILE_APPEND);
$kysely1 = $DBH->prepare($sqlQuery);
$kysely1->execute($data1);
$tulos1=$kysely1->fetch();
$currentUserID=$tulos1[0];
//echo("id=" . $currentUserID);

//hae saadun id avulla kommentit event taulusta

$data3['userID'] = $currentUserID;
$sql3 = "SELECT * FROM tbl_events WHERE userID = :userID";

file_put_contents('log/DBErrors.txt', 'Connection rivi26: '.$_SESSION['userID']."\n", FILE_APPEND);
$kysely3=$DBH->prepare($sql3);
$kysely3->execute($data3);



//$tulos1 = $kysely1->fetch();
//$result = mysqli_query($DBH, $sqlQuery);
file_put_contents('log/DBErrors.txt', 'Connection: '.'rivi12'.$sqlQuery."\n", FILE_APPEND);

// hae saadun id avulla merkkinat tble_events taulusta
$eventArray = array();
//while ($row = mysqli_fetch_assoc($result)) {
  while($tulos = $kysely3->fetch()){
      array_push($eventArray, $tulos);
      
  }
   //array_push($eventArray, $row);
//}
//mysqli_free_result($result);
file_put_contents('log/DBErrors.txt', 'Connection: '.'rivi18'.$sqlQuery."\n", FILE_APPEND);
//mysqli_close($DBH);
echo json_encode($eventArray);
} catch(PDOException $e) {
    echo "Yhteysvirhe: " . $e->getMessage(); 
    file_put_contents('log/DBErrors.txt', 'Connection: '.$e->getMessage()."\n", FILE_APPEND);
}

?>