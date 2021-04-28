<?php
include("includes/header.php");
include("includes/inavindexinfo.php");
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

        
            <br>
            <h3>Käyttöohje</h3>



            Syötä sykevälivaihtelu datasi analysointi välilehdelle. <br />



            Luo päiväkirjamerkintä klikkaamalla jotain päivää, kirjoita olotilasi avautuvaan ponnahdusikkunaan ja paina "OK".<br>
            Kalenterimerkinnän saat poistettua klikkaamalla haluamaasi merkintää
            ja valitsemalla avautuvasta ponnahdusikkunasta "OK".<br /><br />

            <h3>Yhteystiedot</h3>
            Palaute ja tekninen tuki: otium@tuki.fi
            <br /><br />

            <h3>Voit täyttää myös yhteydenottolomakkeen painamalla "ota yhteyttä" nappia</h3>

            <br>

            <form action="contactUs.html">
                <a class="contactUs" href="contactUs.html">Ota yhteyttä</a>
            </form>
<br>
        </article>




        <hr>
        <br>
    </div>
</main>



<?php
//Käyttäjän tila

if ($_SESSION['loggedIn'] == "yes") {
    echo ("Kirjautunut: " . $_SESSION['sfirstname'] . " lastName: " . $_SESSION['slastname']);
}
?>


<?php
include("includes/footer.php")
?>