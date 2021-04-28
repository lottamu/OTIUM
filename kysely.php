

<?php session_start(); ?>

<?php include("includes/header.php");?>


<?php include("includes/inavkysely.php"); ?>


<section>
<nav class="menu-container"><a class="button" href="etusivu.php">E T U S I V U</a><a class="button" 
                href="analysointi.php">A N A L Y S O I N T I</a><a class="button" href="calender.php">K A L E N T E R I</a><a class="button" href="kysely.php">K Y S E L Y</a><a class="button" 
				href="profile.php">P R O F I I L I</a><a class="button" href="info.php">I N F O</a>
</nav>
</section>

<div id="text-container">
<hr>
<br>

    



<?php include('forms/fdailyentery.php'); ?>

<br>


<?php include('db.php'); ?>


    


<hr>
</div>

<?php
 //kirjautuneen käyttäjän userID emailiin avulla
    $data1['email'] = $_SESSION['semail'];
    //var_dump($data1);
    $sql1 = "SELECT id FROM otium where email =  :email";
    $kysely1=$DBH->prepare($sql1);
    $kysely1->execute($data1);
    $tulos1=$kysely1->fetch();
    $currentUserID=$tulos1[0];
   //var_dump($_SESSION);
    // hae kalenteriin taulusta tämän käyttäjän uusimaan merkkinan päivämäärä
   

  ?>

  <?php

if(isset($_POST['submitRecovery'])){
   try {


    $data2['commentSleep']=$_POST['givenFeeling'];
    $data2['commentDate'] = $_SESSION["startDate"];
    $data2['commentStress']=$_POST['givenStress'];
    $data2['commentUserID']=$currentUserID;
    //var_dump($data2);
   
     $sql2="INSERT INTO tbl_kysely (commentSleep, commentUserID, commentStress, commentDate) VALUES ( :commentSleep, :commentUserID, :commentStress, :commentDate);";
     $kysely2 = $DBH->prepare($sql2); 
     $kysely2->execute($data2);
   } catch(PDOException $e) {
   file_put_contents('log/DBErrors.txt', 'index.php: '.$sql2."\n", FILE_APPEND);
   }
  }
  
?>

<?php
/* Submit kysyelyn jälkeen siiretään kalenteriin sivula */
if(isset($_POST['submitRecovery'])){
  header("Location: calender.php");
}
?>











<?php
  include("includes/footer.php")
  ?>