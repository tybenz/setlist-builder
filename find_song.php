<?php
	$title = $_POST['title'];

	$dir = scandir('songs');
	
	$count = 0;
	$matches = array();
	foreach($dir as $file) {
		if(preg_match('/' . $title . '/', $file)) {
			$matches[$count] = $file;
			$count++;
		}
	}
	
	if($count > 0) {
		if($count == 1) {
			$new_title = explode(".", $matches[0]);
			echo 'found-' . $new_title[0];
		} else {
			foreach($matches as $m) {
				echo $m . ',';
			}
		}
	} else {
		echo 'not found';
	}

?>