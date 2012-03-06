<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>LifePoint Church | Setlist Builder</title>
  <link rel="shortcut icon" href="http://lifepointoakdale.org/wp-content/themes/LOP/favicon.ico" />
  <link rel="stylesheet" href="css/base.css" type="text/css" media="all" />
  <link rel="stylesheet" id="current-theme" href="css/styles.css" type="text/css" media="all" />
  <link rel="stylesheet" id="current-theme" href="css/builder.css" type="text/css" media="all" />
  <link rel="stylesheet" id="current-theme" href="css/print.css" type="text/css" media="print" />
  <script type="text/javascript" charset="utf-8" src="http://code.jquery.com/jquery.js"></script>
  <script type="text/javascript" src="js/builder.js"></script>
</head>
<body>
	
		<div id="header">
			<div id="header-inner">
			<h1>
				<a style="font-size: 42px" href="index.html">
					Setlist Builder
				</a>
				<img style="width: 120px; position: absolute; right: 40px; top: 5px" src="images/lp_logo.png" alt=" " />
			</h1>


			<div id="main-navigation">

				<ul class="wat-cf">
					<li class="first"><a href="index.php">Build</a></li>
					<li><a href="add_song.php">Add Song</a></li>
					<li class="active"><a href="manage_songs.php">Manage Songs</a></li>
				</ul>
			</div>
			</div>
		</div>
		
	<div id="container">
	

		<div id="wrapper" class="wat-cf">
			<div id="dialog-overlay">
				<div id="box" class="dialog">
					<div class="block" id="delete-dialog">
						<h2><span>&nbsp;</span><button class="close-dialog right"><img alt="Close" src="images/icons/cross.png" /></button></h2>
						<div class="content">
							<h3 class="left">Are you sure you want to delete</h3>
							<a class="right button" href="#" style="margin: 13px 0 0 18px">
								<img src="images/icons/tick.png" alt="Save" style="position: relative; left: 3px;">
							</a>
							<br class="clear" />
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="main">

				

				<div class="block">

					<h3>Manage Songs</h3>
					<div class="content" style="padding-top: 10px">
						<table class="table" style="width: 90%; margin: auto">
							<tbody>
								<?php
									$songs = scandir('songs');
						
									foreach($songs as $s) {
										if(strpos($s, '.') !== 0 && !strstr($s, 'css')) {
											$string = explode('.', $s);
											$string = $string[0];
											echo '<tr><td><span>' . ucwords(implode(' ', explode('_', $string))) . '</span></td><td class="last" width="100"><span>
													<a href="edit_song.php?file=' . $s . '">edit</a>
													|
													<a class="delete-song" href="#" data-file="' . $s . '">delete</a></span>
													</td></tr>';
										}
									}
					
								?>
							</tbody>
						</table>
					</div>
				</div>
				

			</div>
		</div>
	</div>

</body>
</html>