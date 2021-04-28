<?php session_start(); ?>

<?php include("includes/header.php");?>

<?php include("includes/inavUpdateAccount.php"); ?>


<section>
<nav class="menu-container"><a class="button" href="etusivu.php">E T U S I V U</a><a class="button" href="calender.php">K A L E N T E R I</a><a class="button" 
                href="analysointi.php">A N A L Y S O I N T I</a><a class="button" 
				href="profile.php">P R O F I I L I</a><a class="button" href="info.php">I N F O</a>
</nav>
</section>

<div id="text-container">
<hr>
<article class="teksti">
    
Päivitä tietosi niistä kentistä joita haluat muokata.
</article>
    


<hr>
</div>

<?php include("forms/fupdateProfile.php"); ?>

<?php
include('db.php');
?>

<?php
if(isset($_POST["update"])){


try {

    $data2['email'] = $_SESSION['semail'];

    // id haettiin emailin avulla
    $sqlQuery = "SELECT id FROM otium where email = :email";

    $kysely1 = $DBH->prepare($sqlQuery);
    $kysely1->execute($data2);
    $tulos1 = $kysely1->fetch();
    $currentUserID = $tulos1[0];

    $data3['id'] = $currentUserID;
    $email = $_POST['newEmail'];
    $pwd = password_hash($_POST['newPassword'].$added, PASSWORD_BCRYPT);
    $firstName = $_POST['newFname'];
    $lastName = $_POST['newLname'];
    $gender = $_POST['givenNewgender'];
    $age =$_POST['givenNewage'];

    $sql3 = "UPDATE otium SET email ='$email', first_name = '$firstName', last_name = '$lastName', gender = '$gender', age = '$age' WHERE id = :id";

    $kysely3 = $DBH->prepare($sql3);
    $kysely3->execute($data3);
    //onko annettu salasana on min 8 kirjanta ja molemissa inputeissä sama 
    //Kirjoita salasana kryptatyna 
    session_unset();
    session_destroy();
    header("Location: logInUser.php");
   

} catch (PDOException $e) {
    echo "Yhteysvirhe: " . $e->getMessage();
    file_put_contents('log/DBErrors.txt', 'Connection rivi 40: ' . $e->getMessage() . "\n", FILE_APPEND);
}
}

?>
<?php
//***Luovutetaanko ja palataan takaisin pääsivulle

if(isset($_POST['submitBack'])){
  header("Location: etusivu.php");
}
?>

<br/>
<br/>

















































<?php include("includes/footer.php");?>
