<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>LifePoint Church | Setlist Builder</title>
  <link rel="shortcut icon" href="http://lifepointoakdale.org/wp-content/themes/LOP/favicon.ico" />
  <link rel="stylesheet" href="css/base.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="css/styles.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="css/builder.css" type="text/css" media="screen" />
  <script type="text/javascript" charset="utf-8" src="http://code.jquery.com/jquery.js"></script>
  <script type="text/javascript" src="js/add_song.js"></script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><a style="font-size: 42px" href="index.html"><img style="width: 120px; float: right; position: relative; top: -10px" src="images/lp_logo.png" alt=" " />Setlist Builder</a></h1>


			<div id="main-navigation">

				<ul class="wat-cf">
					<li class="first"><a href="index.php">List</a></li>
					<li class="active"><a href="add_song.php">Add Song</a></li>
					<li><a href="#block-login">Practice</a></li>
				</ul>
			</div>

		</div>

		<div id="wrapper" class="wat-cf">
			<div id="dialog-overlay">
				<div id="box" class="dialog">
					<div class="block" id="block-login">
						<h2><span>Which Song?</span><button id="close-dialog" class="right"><img style="position: relative; top: 2px" alt="Close" src="images/icons/cross.png" /></button></h2>
						<div class="content">
							<table class="table">
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div id="main">

				<div class="block" id="add-song-block">

					<h3>&nbsp;
						<label for="song-title" class="left">Song Title</label><input class="left" id="song-title" value="" />
						<div class="key-select">
							<label style="float: left">Select Key</label>
							<div class="key">A</div>
							<div class="key">Bb</div>
							<div class="key">B</div>
							<div class="key">C</div>
							<div class="key">C#</div>
							<div class="key">D</div>
							<div class="key">Eb</div>
							<div class="key">E</div>
							<div class="key">F</div>
							<div class="key">F#</div>
							<div class="key">G</div>
							<div class="key">G#</div>
						</div>
						<button class="button" id="submit-new-song" class="left">Add Song</button>
					</h3>
					<div class="content">
						<div id="add-song-wrapper">
							<textarea id="add-song"></textarea>
						</div>
					</div>
				</div>
				
				
				</div></div></div></body></html>