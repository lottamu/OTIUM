<?php session_start(); ?>
<?php
require_once "db.php";

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sqlUpdate = "UPDATE tbl_events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
mysqli_query($DBH, $sqlUpdate)
mysqli_close($DBH);

?>