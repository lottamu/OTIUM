<?php
$user = 'noorja';
$pass = 'Password2020';
$host = 'mysql.metropolia.fi';
$dbname = 'noorja';

try { 
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$DBH->exec("SET NAMES utf8;");
	
} catch(PDOException $e) {
	echo "Yhteysvirhe: " . $e->getMessage(); 
	file_put_contents('log/DBErrors.txt', 'Connection: '.$e->getMessage()."\n", FILE_APPEND);
}
?>
