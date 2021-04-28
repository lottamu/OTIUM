<?php session_start(); ?>

<?php include("includes/header.php");?>

<?php include("includes/inavSignIn.php"); ?>
<br/>
<?php include("forms/fsignInUser.php"); ?>


<?php
//***Tarkistetaan syötteet myös palvelimella
if(!strlen($_POST['givenUsername'])>=4){
   $_SESSION['swarningInput']="Illegal username (min 4 chars)";
}else if(!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)){
  $_SESSION['swarningInput']="Illegal email";
}else if(!strlen($_POST['givenPassword'])>=8){
  $_SESSION['swarningInput']="Illegal password (min 8 chars)";
}else if(!$_POST['givenPassword']== $_POST['givenPasswordVerify']){
  $_SESSION['swarningInput']="Given password and verified not same";
}else{
  unset($_SESSION['swarningInput']);
 
  //***Tiedot sessioon - annettu oikeanlaisena
  $_SESSION['sloggedIn']="yes";
  $_SESSION['sfirstname']=$_POST['givenFirstname'];
  $_SESSION['slastname']=$_POST['givenLastname'];
  $_SESSION['semail']= $_POST['givenEmail'];
 
 //Tiedot kantaan
 $data['id'] = 2;
  $data['first_name'] = $_POST['givenFirstname'];
  $data['last_name'] = $_POST['givenLastname'];
  $data['email'] = $_POST['givenEmail'];
  $data['age'] = $_POST['givenAge'];
  $data['gender'] = $_POST['givenGender'];
  $data['height'] = $_POST['givenHeight'];
  $data['weight'] = $_POST['givenWeight'];
  
  //Tiedot kantaan
   $data['first_name'] = $_POST['givenUsername'];
  $data['email'] = $_POST['givenEmail'];
  $added='#â‚¬%&&/'; //suolataan annettua salasanaa
  $data['pwd'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
  try {
    
    //***Email ei saa olla käytetty aiemmin
    $sql = "SELECT COUNT(*) FROM otium where email like  " . "'".$_POST['givenEmail']."'"  ;
    $kysely=$DBH->prepare($sql);
    $kysely->execute();				
    $tulos=$kysely->fetch();
    if($tulos[0] == 0){ //email ei ole käytössä
     $STH = $DBH->prepare("INSERT INTO otium (email, pwd) VALUES (:email, :pwd);");
     $STH->execute($data);
     header("Location: etusivu.php"); //Palataan pääsivulle kirjautuneena
    }else{
      $_SESSION['swarningInput']="Email is reserved";
    }
  } catch(PDOException $e) {
    file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);
    $_SESSION['swarningInput'] = 'Database problem';
    
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
  echo("<p class=\"warning\">ILLEGAL INPUT: ". $_SESSION['swarningInput']."</p>");
}
?>


<?php include("includes/footer.php");?>