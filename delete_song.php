<?php
	$song = $_GET['file'];
	
	unlink('songs/' . $song);
	
	header('Location: manage_songs.php');


?>