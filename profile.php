<?php session_start(); ?>

<?php
include("includes/header.php");
include("includes/inavindexprofile.php");
?>

<br>

<section>
<nav class="menu-container"><a class="button" href="etusivu.php">E T U S I V U</a><a class="button" href="calender.php">K A L E N T E R I</a><a class="button" 
                href="analysointi.php">A N A L Y S O I N T I</a><a class="button" 
				href="profile.php">P R O F I I L I</a><a class="button" href="info.php">I N F O</a><a class="button" href="aboutUs.html">M E I S T Ä</a>
</nav>
</section>

<main>
    <div id="text-container">
				<br>
				<hr>
				

			<article class="teksti">

			<?php

echo "<h3 class='etuNumi'>Etunimi: <span class='firstName'>" .$_SESSION['sfirstname']. "</span></h3>";
echo "<h3 class='sukuNimi'>Sukunimi: <span class='lastName'>" .$_SESSION['slastname']. "</span></h3>";
echo "<h3 class='sähköposti'>Sähköposti: <span class='email'>" .$_SESSION['semail']. "</span></h3>";
echo "<h3 class='syntymävuosi'>Syntymävuosi: <span class='age'>" .$_SESSION['sage']. "</span></h3>";


?>
<br>
<fieldset>
<br>
			<form action="update-profile.php">
			<button id="paivitaTili" type="submit">Päivitä tili</button>
		</form>
		
			Jos haluat muokata omia tietojasi, valitse "Päivitä tili". Sinut ohjataan uudelle <br> sivulle, jossa voit päivittää omat tietosi. <br>
			Tietojen täyttämisen jälkeen paina "Tallenna".
			<br>
			<br>
			</fieldset>
			<br>

			<fieldset>
			<form method="POST" action="delete-profile.php" onsubmit="return confirmDesactiv()"> <br>
					<button id="poistaTili" type="submit">Poista tili</button>
				</form>

			
				Voit poistaa käyttäjätilisi valitsemalla "Poista tili."  <br>
				Kaikki tiliisi liitetyt tietosi poistuvat pysyvästi, kun poistat tilisi. Tietoturvasyistä <br> poistettua tiliä ei voida enää palauttaa.
				<br>
				<br>
				</fieldset>
				
				

				

			</article>

				<hr/>
				<br/>
			</div>
			</main>	



<script>
	function confirmDesactiv() {
		if (confirm("Painamalla OK kaikki käyttäjätilisi tiedot poistuvat pysyvästi. Oletko varma, että haluat poistaa tilisi pysyvästi?"))
			return true;

		return false;
	}
</script>

<?php
  include("includes/footer.php")
  ?>