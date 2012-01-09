<?php


	$string = '<!DOCTYPE html>
	<html>
	<head>
		<title>' . stripslashes($_POST['title']) . '</title>

		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>

	<div id="song-key">' . $_POST['key'] . '</div>

	<pre>
' . stripslashes($_POST['chords']) . '
	</pre>	


	</body>
	</html>';
	
	var_dump($string);

	
	
	$filename = strtolower(preg_replace('/\s/', '_', $_POST[title]));
	
	
	var_dump($filename);

	$new_file = fopen('songs/' . $filename . '.html', 'w');
	fwrite($new_file, $string);
	fclose($new_file);

	echo 'success';
?>