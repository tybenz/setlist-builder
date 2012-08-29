<?php
	$title = $_POST['title'];
  $title = implode('_', explode(' ', $title));

	$dir = scandir('songs');
	
	$count = 0;
	$matches = array();
	foreach($dir as $file) {
		if(preg_match('/' . $title . '/', $file)) {
			$matches[$count] = $file;
			$count++;
		}
	}
	
	if($count) {
		if($count == 1) {
      echo file_get_contents( 'songs/' . $matches[0] );
		} else {
			foreach($matches as $m) {
				echo $m . ',';
			}
		}
	} else {
		echo 'not found';
	}

?>
