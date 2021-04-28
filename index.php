
<?php
include("includes/header.php");
include("includes/inavfirstpage.php");
?>

<br>


<main>




<figure>
	<img src="./kuvat/Logo-otuim.png" class="image" alt="Otium"/>
</figure>
<br>

<div id="text-container">
				
			<hr>
			<article class="teksti">
				
				Tervetuloa OTIUM:iin! OTIUM on sovellus, jonka toiminta perustuu sykevälivaihtelusta mitatun datan eli HRV-datan analysoimiseen.<br/><br/>
                Aloita HRV-mittaus omalla sykevälivaihtelua mittaavalla laitteellasi ja syötä mittaustuloksesi OTIUM:iin.<br/><br/>
                Sovelluksessa voit myös seurata hyvinvointiasi lisäämällä kalenteriin merkintöjä vireystilaan ja stressitasoon liittyen. <br>
				
			</article>


				<hr>
                <br>
</div>
</main>	


<?php
        //Käyttäjän tila

        if($_SESSION['loggedIn']=="yes"){
            echo("Logged in: " .$_SESSION['sfirstname']. " lastName: " . $_SESSION['slastname']);
        }
    ?>


<?php
  include("includes/footer.php")
  ?>