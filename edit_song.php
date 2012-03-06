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
  <script type="text/javascript" src="js/add_song.js"></script>
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
					<li><a href="manage_songs.php">Manage Songs</a></li>
				</ul>
			</div>
			</div>
		</div>
		
	<div id="container">
	

		<div id="wrapper" class="wat-cf">
			<div id="dialog-overlay">
				<div id="box" class="dialog">
					<div class="block" id="keys">
						<h2><span>Select Key</span><button id="close-dialog" class="right"><img style="position: relative; top: 2px" alt="Close" src="images/icons/cross.png" /></button></h2>
						<div class="content">
							<br />
							<div class="key-select right" id="current-key">
								<label style="float: left">Current Key</label>
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
							<br />
							<br />
							<br />
							<div class="key-select right" id="default-key">
								<label style="float: left">Default Key</label>
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
							<br />
							<br />
							<br />
							<button id="submit-new-song" class="right">Edit Song</button>
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="main">

				

				<div class="block">

					<h3>Edit Song</h3>
					<div class="content" style="padding-top: 10px">
						<div id="example-song">
							
							
							<div class="block" style="padding: 0">
								<h3 style="font-size: 16px">Example</h3>
							<div class="content" style="padding: 10px">
								<pre>
<strong>  G           C               D</strong>
Every move I make, I make in You
<strong>    C		</strong>
You make me move, Jesus
<strong>   G		C		   D    C</strong>
Every breath I take, I breathe in You


<strong>G    C    D    C</strong>    [repeat]


<strong>  G	 C/A	 D/B	  C</strong>
Waves of mercy, waves of grace
<strong>  G   C/A    D/B      C        G</strong>
Everywhere I look, I see Your face
<strong>      C/A      D/B     C</strong>
Your love has captured me
<strong> G    C/A	D/B	   C     G</strong>
Oh my God, this love, how can it be?
								</pre>
							</div>
						</div>
						</div>
						
						<h2 style="padding-left: 10px">Instructions:</h2>
						
						<ol id="instructions">
							<li>Enter song title</li>
							<li>Paste or type in lyrics and chords</li>
							<li>Make sure any non-chord pieces of text are not on the same line as any of the chords</li>
							<li>If you need any words on the same line as chords, make sure to wrap them in square brackets (see example)</li>
							<li>AFTER you are finished editing the text, mark each line containing chords in the margin</li>
							<li>Select the key that the song is in (Current Key)</li>
							<li>Select the key you prefer the song to be in (Default Key)</li>
						</ol>
						
						<br class="clear" />
						
						

					</div>
				</div>

				<div class="block">
					<?php
						$song_name = explode('.', $_GET['file']);
						$song_name = implode(' ', explode('_', $song_name[0]));
					?>
					<h3 style="padding: 25px 10px 0px">
						<label for="song-title" class="left">Song Title</label><input class="left" id="song-title" value="<?php echo ucwords($song_name) ?>" />
						<button class="button" id="select-key" class="left">Edit Song</button><br class="clear" />
					</h3>
					<div class="content" style="padding: 0;">
						<div id="add-song-wrapper">
							<div id="add-song-margin">
							</div>
							<textarea id="add-song"></textarea>
							<br class="clear" />
						</div>

					</div>
				</div>
				
				<iframe id="song" src="songs/<?php echo $_GET['file']; ?>" style="display: none"></iframe>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript">
	$(function() {
		$('#song').load(function() {
			$('#add-song').val($('#song').contents().find('pre').text());
		});
	});
  </script>
</html>