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
  <script type="text/javascript" charset="utf-8" src="js/jquery.min.js"></script>
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
					<li class="active"><a href="add_song.php">Add Song</a></li>
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
						<h2><span>Select Key</span><button id="close-dialog" class="close-dialog right"><img alt="Close" src="images/icons/cross.png" /></button></h2>
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
							<button id="submit-new-song" class="right">Add Song</button>
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="main">

				

				<div class="block">


          <form action="write_song.php" method="post">
            <h3>
              <span style="float: left">Add Song</span>
              <div class="right" id="add-song-form">
                <label for="song-title">Song Title</label><input id="song-title" name="title" value="" />
                <input class="button right" id="select-key" type="submit" value="Add Song">
              </div>
              <br class="clear" />
            </h3>
            <div class="content" style="padding: 0;">
              <div id="add-song-wrapper">
                <textarea id="add-song" name="chords"></textarea>
                <br class="clear" />
              </div>
  
            </div>
          </form>
        </div>
				

			</div>
		</div>
	</div>

</body>
</html>
