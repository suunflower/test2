<?php

$con = mysqli_connect("", "root");
mysqli_select_db($con, "gb");
function getEntries($con){
	$sql = "SELECT name, kommentar, id, datum FROM guestbook ORDER BY datum DESC";
	$res = mysqli_query($con, $sql);
	while($row = mysqli_fetch_assoc($res)){
		$entries[] = $row;
	}
	return $entries;
}
function delete($con){
	$sql = "DELETE FROM guestbook WHERE id = ".$_GET['delete'];
	mysqli_query($con, $sql);
    header('Location: http://kathisag.bplaced.net/gb/');
    exit;
}
function newEntry($con){
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$kommentar = mysqli_real_escape_string($con, $_POST['new']);
	$datum = date('Y-n-d - H:i:s');
	$sql = "INSERT INTO guestbook(name, kommentar, datum) VALUES ('$name', '$kommentar', '$datum')";
	mysqli_query($con, $sql);
}
function updateEntry($con){
	$edited_post = mysqli_real_escape_string($con, $_POST['new']);
	$sql = "UPDATE `guestbook` SET `kommentar`= '$edited_post' WHERE id = ".$_GET['edit'];
	mysqli_query($con, $sql);
    header('Location: http://kathisag.bplaced.net/gb/');
    exit;
}
