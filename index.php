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
	<div id="container">
		<div id="header">
			<h1><a style="font-size: 42px" href="index.html"><img style="width: 120px; float: right; position: relative; top: -10px" src="images/lp_logo.png" alt=" " />Setlist Builder</a></h1>


			<div id="main-navigation">

				<ul class="wat-cf">
					<li class="first active"><a href="index.php">List</a></li>
					<li><a href="add_song.php">Add Song</a></li>
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

				<div class="block" id="list">

					<h3></h3>
					<div class="content">
						<br />
						<button class="button right" style="margin-right: 20px; background-color: #444; color: #fff" id="print-list">Print</button>
						<button class="button right" id="print-no-capo">Print w/o Capo</button>
						<br class="clear" />
						<br />
						<div class="inner">
							<table class="table">

								<tr>
									<th class="first">&nbsp;</th>
									<th style="min-width: 360px">Name</th>
									<th style="min-width: 325px">Key</th>
									<th>Capo</th>
									<th class="last">&nbsp;</th>
								</tr>
								<tr>
									<td>1.</td>
									<td><input style="width: 302px" value="" id="song-to-add" /><button id="add-to-list">Add</button></td>
									<td>
									<div class="key-select">
									<div class="key">A</div><div class="key">Bb</div><div class="key">B</div><div class="key">C</div><div class="key">C#</div><div class="key">D</div><div class="key">Eb</div><div class="key">E</div><div class="key">F</div><div class="key">F#</div><div class="key">G</div><div class="key">G#</div>
									</div>
									</td>
									<td>----</td>
									<td class="last"><a href="#">edit</a> | <a href="#">remove</a></td>
								</tr>

							</table>

						</div>
					</div>
				</div>
				
				<!--
				<div class="block">	
					<h3>Our God</h3>
					<div class="content">
						<iframe src="songs/our_god.html"></iframe>
					</div>
				</div>
				-->

			</div>
		</div>
	</div>

</body>
</html>