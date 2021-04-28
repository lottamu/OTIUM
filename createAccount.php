<?php include("includes/header.php");?>

<?php include("includes/inavCreateAccount.php"); ?>

<?php include("forms/fcreateAccount.php"); ?>


<?php
//Lomakkeen submit painettu?
if(isset($_POST['submitUser'])){
  //***Tarkistetaan syötteet myös palvelimella
  if(strlen($_POST['givenFirstname'])<2){
   $_SESSION['swarningInput']="Nimi ei kelpaa, syötä vähintään 3 kirjainta.";
  }else if(strlen($_POST['givenLastname'])<2){
    $_SESSION['swarningInput']="Nimi ei kelpaa, syötä vähintään 3 kirjainta.";
   }else if(!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)){
   $_SESSION['swarningInput']="Sähköpostiosoite ei kelpaa.";
  }else if(strlen($_POST['givenPassword'])<8){
   $_SESSION['swarningInput']="Salasana ei kelpaa, syötä vähintään 8 kirjainta.";
  }else if($_POST['givenPassword']!= $_POST['givenPasswordVerify']){
   $_SESSION['swarningInput']="Salasanat eivät täsmää";
  }else{
   unset($_SESSION['swarningInput']);
 
  
  
  //Tiedot kantaan
  
   $data['first_name'] = $_POST['givenFirstname'];
   $data['last_name'] = $_POST['givenLastname'];
   $data['email'] = $_POST['givenEmail'];
   $data['age'] = $_POST['givenAge'];
   $data['gender'] = $_POST['givenGender'];
   /* $data['height'] = $_POST['givenHeight'];
   $data['weight'] = $_POST['givenWeight']; */
  //suolataan annettua salasanaa
   $data['pwd'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
   try {
    //***Email ei saa olla käytetty aiemmin
    $sql = "SELECT COUNT(*) FROM otium where email like  " . "'".$_POST['givenEmail']."'"  ;
    $kysely=$DBH->prepare($sql);
    $kysely->execute();				
    $tulos=$kysely->fetch();
    if($tulos[0] == 0){ //email ei ole käytössä
     $STH = $DBH->prepare("INSERT INTO otium (first_name, last_name, email, pwd, age, gender) VALUES (:first_name, :last_name, :email, :pwd, :age, :gender);");
     $STH->execute($data);
     
     //***Tiedot sessioon - annettu oikeanlaisena
   $_SESSION['sloggedIn']="yes";
   $_SESSION['sfirstname']=$_POST['givenFirstname'];
   $_SESSION['slastname']=$_POST['givenLastname'];
   $_SESSION['semail']= $_POST['givenEmail'];
/*    $_SESSION['sweight']=$_POST['givenWeight'];
   $_SESSION['sheight']=$_POST['givenHeight']; */
   $_SESSION['sgender']=$_POST['givenGender'];
   $_SESSION['sage']=$_POST['givenAge'];



   header("Location: etusivu.php"); //Palataan pääsivulle kirjautuneena
    }else{
      $_SESSION['swarningInput']="Sähköposti on varattu";
    }
   } catch(PDOException $e) {
    file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);
    $_SESSION['swarningInput'] = 'Tietokantaongelma, ole yhteydessä OTIUM:in asiakaspalveluun';
    
   }
  }
}
?>

<?php
//***Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
//ilma  rekisteröintiä?
if(isset($_POST['submitBack'])){
  session_unset();
  session_destroy();
  header("Location: index.php");
}
?>

<?php
  //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
if(isset($_SESSION['swarningInput'])){
  echo("<p class=\"warning\">VIRHEELLINEN SYÖTE: ". $_SESSION['swarningInput']."</p>");
}
?>

<br/>
<br/>


<?php include("includes/footer.php");?>