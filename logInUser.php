<?php include("includes/header.php"); ?>
<?php include("includes/inavLogInUser.php"); ?>
<?php include("forms/flogInUser.php"); ?>


<?php
//Lomakkeen submit painettu?
if(isset($_POST['submitUser'])){
  //***Tarkistetaan syötteet myös palvelimella
  if(!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)){
   $_SESSION['swarningInput']="Väärä sähköpostiosoite";
  }else{
    unset($_SESSION['swarningInput']); 
     try {
      //Tiedot kannasta, hakuehto
      $data['email'] = $_POST['givenEmail'];
      $STH = $DBH->prepare("SELECT first_name, last_name, email, pwd, weight, height, gender, age  FROM otium WHERE Email = :email;");
      $STH->execute($data);
      $STH->setFetchMode(PDO::FETCH_OBJ);
      $tulosOlio=$STH->fetch();
      //lomakkeelle annettu salasana + suoja
      $givenPasswordAdded = $_POST['givenPassword'].$added;
 
       //Löytyikö email kannasta?
       if($tulosOlio!=NULL){
          //email löytyi

          if(password_verify($givenPasswordAdded,$tulosOlio->pwd)){
              $_SESSION['sloggedIn']="yes";
              $_SESSION['sfirstname']=$tulosOlio->first_name;
              $_SESSION['slastname']=$tulosOlio->last_name;
              $_SESSION['semail']=$tulosOlio->email;
              $_SESSION['sweight']=$tulosOlio->weight;
              $_SESSION['sheight']=$tulosOlio->height;
              $_SESSION['sgender']=$tulosOlio->gender;
              $_SESSION['sage']=$tulosOlio->age;
              header("Location: etusivu.php"); //Palataan pääsivulle kirjautuneena
              
          }else{
            $_SESSION['swarningInput']="Väärä salasana";
          }
      }else{
        $_SESSION['swarningInput']="Väärä sähköpostiosoite";
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