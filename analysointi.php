<?php
include("includes/header.php");
include("includes/inavindexanalysointi.php");
?>

<br>

<section>
    <nav class="menu-container"><a class="button" href="etusivu.php">E T U S I V U</a><a class="button" href="calender.php">K A L E N T E R I</a><a class="button" href="analysointi.php">A N A L Y S O I N T I</a><a class="button" href="profile.php">P R O F I I L I</a><a class="button" href="info.php">I N F O</a><a class="button" href="aboutUs.html">M E I S T Ä</a>
    </nav>
</section>


<main>
    <div id="text-container">
        <br>
        <hr>
        <article class="teksti">

            Tällä sivulla voit tarkastella omia kalenterimerkintöjäsi sekä kyselyn tuloksia. <br> Voit myös tarkastella analysoitua HRV-dataasi. <br>
            <br>Sykevälivaihtelun englanninkielinen lyhenne <b>HRV</b> tulee sanoista <b>Heart Rate Variability</b>. Sykevälivaihtelu tarkoittaa sekä peräkkäisen sydämen lyöntien välisen ajan vaihtelua että välittömiä muutoksia ihmisen sykkeessä. HRV-dataa tarkastelemalla voidaan saada kokonaisvaltainen kuva ihmisen terveydentilasta.
            <br>
            <br>
            <h2>HRV chartti</h2>
            <div id="chartdiv"></div>
            <h2>Virkeystaso chartti</h2>
            <p>weeks avarge result is ( 3 ), improvwe your sleeping.</p>
            <div id="chartdiv3"></div>
            <h2>StressIndexiin chartti</h2>
            <div id="chartdiv2"></div>

        </article>

        <!-- HRV chartti -->
        <script>
            // Haetan data omasta APistä 
            fetch('https://users.metropolia.fi/~noorja/WSK12021/OTIUM02-offical/OTIUM02/API/hrv.php')
                .then((response) => {
                    return response.json();
                })
                .then((data1) => {
                    //console.log(data1);
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart
                    var chart = am4core.create("chartdiv", am4charts.XYChart);
                    chart.paddingRight = 20;

                    chart.data = data1;
                    chart.dateFormatter.inputDateFormat = "MM-dd";

                    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                    dateAxis.renderer.minGridDistance = 50;

                    dateAxis.skipEmptyPeriods = true;

                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    valueAxis.tooltip.disabled = true;

                    var series = chart.series.push(new am4charts.StepLineSeries());
                    series.dataFields.dateX = "day";
                    series.dataFields.valueY = "value";
                    series.tooltipText = "{valueY.value}";
                    series.strokeWidth = 3;

                    chart.cursor = new am4charts.XYCursor();
                    chart.cursor.xAxis = dateAxis;
                    chart.cursor.fullWidthLineX = true;
                    chart.cursor.lineX.strokeWidth = 0;
                    chart.cursor.lineX.fill = chart.colors.getIndex(2);
                    chart.cursor.lineX.fillOpacity = 0.1;

                    chart.scrollbarX = new am4core.Scrollbar();

                });
        </script>


        <!-- StressIndexiin chartti -->
        <script>
            // Haetan data omasta APistä
            fetch('https://users.metropolia.fi/~noorja/WSK12021/OTIUM02-offical/OTIUM02/API/stressi.php')
                .then((response) => {
                    return response.json();
                })
                .then((data2) => {
                    console.log(data2);

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv2", am4charts.XYChart);

                    chart.data = data2;

                    // Create axes
                    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                    dateAxis.renderer.minGridDistance = 60;


                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                    // Create series
                    var series = chart.series.push(new am4charts.LineSeries());
                    series.dataFields.valueY = "value";
                    series.dataFields.dateX = "date";
                    series.tooltipText = "{value}"

                    series.tooltip.pointerOrientation = "vertical";

                    chart.cursor = new am4charts.XYCursor();
                    chart.cursor.snapToSeries = series;
                    chart.cursor.xAxis = dateAxis;

                    //chart.scrollbarY = new am4core.Scrollbar();
                    chart.scrollbarX = new am4core.Scrollbar();

                }); // end am4core.ready()
        </script>

        <!-- Virkeystason chartti -->
        <script>
            // Haetan data omasta APistä
            fetch('https://users.metropolia.fi/~noorja/WSK12021/OTIUM02-offical/OTIUM02/API/awakeness.php')
                .then((response) => {
                    return response.json();
                })
                .then((data3) => {
                    console.log(data3);

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv3", am4charts.XYChart);

                    chart.data = data3;

                    // Create axes
                    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                    dateAxis.renderer.minGridDistance = 60;


                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                    // Create series
                    var series = chart.series.push(new am4charts.LineSeries());
                    series.dataFields.valueY = "value";
                    series.dataFields.dateX = "date";
                    series.tooltipText = "{value}"

                    series.tooltip.pointerOrientation = "vertical";

                    chart.cursor = new am4charts.XYCursor();
                    chart.cursor.snapToSeries = series;
                    chart.cursor.xAxis = dateAxis;

                    //chart.scrollbarY = new am4core.Scrollbar();
                    chart.scrollbarX = new am4core.Scrollbar();

                }); // end am4core.ready()
        </script>

    </div>
</main>


<?php
//Käyttäjän tila

if ($_SESSION['loggedIn'] == "yes") {
    echo ("Logged in: " . $_SESSION['sfirstname'] . " lastName: " . $_SESSION['slastname']);
}
?>
<div id="text-container2">


    <article class="teksti">

        <h2 class="table-text">Kalenterimerkinnät</h2>
        <p class="table-ptext">Taulukossa on esitetty kalenteriin tehdyt merkinnät uusimmasta vanhimpaan.</p>

        <?php
        //kirjautuneen käyttäjän userID?
        $data1['email'] = $_SESSION['semail'];

        //var_dump($data1);
        $sql1 = "SELECT id FROM otium where email =  :email";
        $kysely1 = $DBH->prepare($sql1);
        $kysely1->execute($data1);
        $tulos1 = $kysely1->fetch();
        $currentUserID = $tulos1[0];

        // Print out calnder data, what currentUser has inputted
        $data3['userID'] = $currentUserID;
        $sql3 = "SELECT title, start FROM tbl_events WHERE userID = :userID ORDER BY start DESC LIMIT 10";
        $kysely3 = $DBH->prepare($sql3);
        $kysely3->execute($data3);


        echo ("<table>
	 	<tr>
			<th>Kalenterimerkintä </th>
      <th>Päivämäärä</th>
		</tr>");

        while ($row = $kysely3->fetch()) {
            echo ("<tr><td>" . $row["title"] . "</td>
				<td>" . $row["start"] . "</td>
				</tr>");
        }

        echo ("</table>");
        ?>
        <br>

        <h2 class="table-text">Kyselyiden tulokset</h2>
        <br>
        <p class="table-ptext">Taulukossa on esitetty kyselyiden tulokset asteikolla 1-5 </p>
        <mark class="red"><b>1</b></mark> = Erittäin väsynyt / Erittäin stressaantunut
        <br>
        <mark class="red"><b>2</b></mark> = Melko väsynyt / Hyvin stressaantunut
        <br>
        <mark class="blue"><b>3</b></mark> = En virkeä enkä väsynyt / Jonkin verran stressaantunut
        <br>
        <mark class="green"><b>4</b></mark> = Melko virkeä / Vähän stressaantunut
        <br>
        <mark class="green"><b>5</b></mark> = Erittäin virkeä / En yhtään stressaantunut
        <br><br>

        <mark class="red"><b>Punaiselle</b></mark> arvolle sijoittuvat taulukon tulokset kertovat kovasta stressistä ja uupumuksesta, muista levätä hyvin ja antaa tarpeeksi aikaa itsellesi voidaksesi hyvin!
        <br>
        <mark class="blue"><b>Siniselle</b></mark> arvolle sijoittuvat taulukon tulokset vaativat huomiotasi, paranna elämäntapojasi ja nuku riittävästi jotta terveydentilasi ei pääse huonontumaan!
        <br>
        <mark class="green"><b>Vihreälle</b></mark> arvolle sijoittuvat taulukon tulokset viittaavat hyvään ja tasaiseen terveydentilaan, jatka samaan malliin!
        <br>
        <br>

        <?php
        //kirjautuneen käyttäjän userID?
        $data2['email'] = $_SESSION['semail'];

        //var_dump($data1);
        $sql2 = "SELECT id FROM otium where email =  :email";
        $kysely2 = $DBH->prepare($sql2);
        $kysely2->execute($data2);
        $tulos2 = $kysely2->fetch();
        $currentUserID = $tulos2[0];

        // Print out calnder data, what currentUser has inputted
        $data4['commentUserID'] = $currentUserID;
        $sql4 = "SELECT commentSleep, commentStress, commentDate FROM tbl_kysely WHERE commentUserID  = :commentUserID  ORDER BY commentDate DESC LIMIT 10";
        $kysely4 = $DBH->prepare($sql4);
        $kysely4->execute($data4);

        echo ("<table>
                
                <tr>
                    <th>Virkeystaso</th>
                    <th>Stressitaso</th>
                    <th>Päivämäärä</th>
                </tr>");

        while ($row = $kysely4->fetch()) {
            echo ("<tr>
        <td>" . $row["commentSleep"] . "</td>
        <td>" . $row["commentStress"] . "</td>
        <td>" . $row["commentDate"] . "</td>
        
        </tr>");
        }

        echo ("</table>");

        ?>



    </article>
    <hr>
</div>
<br>

<?php
include("includes/footer.php")
?>