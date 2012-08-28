<?php
	$filename = strtolower(preg_replace('/\s/', '_', $_POST[title]));

	$new_file = fopen('songs/' . $filename . '.txt', 'w');
	fwrite($new_file, $_POST['chords']);
	fclose($new_file);

	header('Location: index.php');
?>
