<?php session_start(); ?>
<?php

require_once "db.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";


//kirjautuneen käyttäjän userID?
$data2['email'] = $_SESSION['semail'];
//var_dump($data1);
$sql1 = "SELECT id FROM otium where email =  :email";
$kysely1 = $DBH->prepare($sql1);
$kysely1->execute($data2);
$tulos1 = $kysely1->fetch();

$data1['userID'] = $tulos1[0];

try {
	//Tiedot kantaan
	/* var_dump($_POST); */

	$data1['title'] = $_POST['title'];
	$data1['start'] = $_POST['start'];
	$data1['end'] = $_POST['end'];

	$STH = $DBH->prepare("INSERT INTO tbl_events (title, start, end, userID) VALUES (:title, :start, :end, :userID);");
	$STH->execute($data1);

	$data4['userID'] = $data1['userID'];
	$sql4 = "SELECT start FROM tbl_events where userID =:userID ORDER BY start DESC LIMIT 1";

	$kysely4 = $DBH->prepare($sql4);
	$kysely4->execute($data4);
	$tulos2 = $kysely4->fetch();

	$_SESSION["startDate"] = $tulos2[0];
	

	file_put_contents('log/DBErrors.txt', "Päiväys:" . $_SESSION["startDate"],FILE_APPEND);

	file_put_contents('log/DBErrors.txt', "Merkintä on:"  . $title . "  " . $start . "  " . $end . "  " . ' id ' . $data1['userID'] . ' email ' . $_SESSION['semail'],FILE_APPEND);
	if (!$result) {
		$result = mysqli_error($DBH);
	}
} catch (PDOException $e) {
	echo "Yhteysvirhe: " . $e->getMessage();
	file_put_contents('log/DBErrors.txt', 'Connection: ' . $e->getMessage() . "\n", FILE_APPEND);
}

?>