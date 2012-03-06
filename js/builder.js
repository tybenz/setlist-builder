$(function() {

	var song_count = 0;

	var notes = ["A", "Bb", "B", "C", "C#", "D", "Eb", "E", "F", "F#", "G", "G#"];
	var numbers = {"A": 0, "Bb": 1, "B": 2, "C": 3, "C#": 4, "D": 5, "Eb": 6, "E": 7, "F": 8, "F#": 9, "G": 10, "G#": 11};
	
	var keys = {};
	var capos = {};

	$('#add-to-list').click(addSong);
	
	$('#song-to-add').keypress(function(e) {
		if(e.which == 13) {
			e.preventDefault();
			addSong();
		}
	});
	
	$('#print-list').click(function() {
		$('#list').hide();
		$('#header').hide();
		
		window.print();
		
		$('#list').show();
		$('#header').show();
	});
	
	$('#print-no-capo').click(function() {
		$('#list').hide();
		$('#header').hide();
		
		capo(0);
		
		window.print();
		
		capo(1);
		
		$('#list').show();
		$('#header').show();
	});
	
	function addSong() {
		var string = $('#song-to-add').val().split(' ').join('_');
		
		$.ajax({
			type: 'post',
			url: 'find_song.php',
			data: 'title=' + string,
			success: function(response) {
				//if response starts with found we found an exact match
				//if response is not found then no song was found
				//if response is anything else, it will be a list of multiple songs
				//and we prompt the user to choose between them
				if(response.indexOf('found') == 0) {
					appendFrame(response.split('-')[1]);
				} else if(response == 'not found'){
					notFound();
				} else {
					string = whichSong(response);
				}
			}
		});
	}
	
	function appendFrame(title) {
		song_count++;
		$('#song-to-add').val('');
		
		title = title.split('_').join(' ').capitalize();
		var file = title.toLowerCase().split(' ').join('_') + '.html';
		keys[file] = "";

		$('tbody tr:last')
			.before('<tr id="' + file + '"> \
				<td>' + song_count + '.</td> \
				<td>' + title + '</td> \
				<td> \
				<div class="key-select"> \
				<div class="key">A</div><div class="key">Bb</div><div class="key">B</div><div class="key">C</div> \
				<div class="key">C#</div><div class="key">D</div><div class="key">Eb</div><div class="key">E</div> \
				<div class="key">F</div><div class="key">F#</div><div class="key">G</div><div class="key">G#</div> \
				</div> \
				</td> \
				<td><div class="capo-select"><select id="capo"><option value="0">0</option><option value="1">1</option> \
				<option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option> \
				<option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option> \
				<option value="10">10</option><option value="11">11</option></select></div></td> \
				<td class="last"><a href="#">edit</a> | <a href="#">remove</a></td> \
			</tr>')
			.find('td:first').text((song_count + 1) + '.');
		
		var new_song = $('<div class="block" data-id="' + file + '"><h3>' + title + '<span class="capo-num"></span></h3><div class="content"></div></div>');
			
		var iframe = $('<iframe src="songs/' + file + '"></iframe>');
		
		iframe.load(function() {
			var iframe = $(this).contents();

			var key = iframe.find('#song-key').text();
			var title = iframe.find('title').text();
			
			keys[file] = key;
			
			$('td').each(function() {
				$this = $(this);
				if($this.text() == title) {
					var cell = $this.siblings('td:eq(1)');
			
					cell.find('.key').each(function() {
						var $this = $(this);
						if($this.text() == key) {
							$this.addClass('active');
						}
					});
				}
			});

			$(this).height(iframe.height());
		});
		new_song.find('.content').append(iframe);
		
		$('#main').append(new_song);
		
		//bind key selector to transpose
		$('[id="' + file + '"] .key').click(function() {
			var $this = $(this);
			var new_key = $this.text();

			var diff = numbers[new_key] - numbers[keys[file]];

			$('[data-id="' + file + '"] iframe').contents().find('strong').each(function() {
				$(this).text(transpose(diff, $(this).text()));
			});

			keys[file] = $this.text();
			$('[id="' + file + '"] .key').removeClass('active');
			$this.addClass('active');
		});
		
		//bind capo-selector
		$('[id="' + file + '"] .capo-select select').change(function() {
			var val = $(this).val();
			
			$('[data-id="' + file + '"] .capo-num').text('Capo: ' + val);

			if(val == 0) {
				$('[data-id="' + file + '"] .capo-num').text('');
			}
		});
		
		//bind remove link
		$('[id="' + file + '"] a:contains(remove)').click(function(e) {
			e.preventDefault();
			var row = $(this).parents('tr');
			var id = row.attr('id');
			var num = parseInt(row.find('td:first').text());

			$('[data-id="' + id + '"]').remove();
			
			var start = 0;
			row.siblings('tr').each(function() {
				var i = parseInt($(this).find('td:first').text());
				
				if(i > num) {
					$(this).find('td:first').text(i - 1 + '.');
				}
			});
			
			row.remove();
			
			song_count--;
		});
	}
	
	function capo(on) {
		var sign = '+';
		if(on) {
			sign = '-';
		}		
		$('[data-id]').each(function() {
			var capo = $(this).find('.capo-num').text().split(' ');
			capo = capo[1] ? parseInt(sign + capo[1]) : 0;
				
			$(this).find('iframe').contents().find('strong').each(function() {
				$(this).text(transpose(capo, $(this).text()));
			});
		});
	}
	
	function notFound() {
		var win = $(window);
		$('#not-found').show();
		$('#dialog-overlay').show().height(win.height()).width(win.width());
	}
	
	function transpose(diff, note) {
		var dub = note.split('/');
		var flat = (note.search(/b/) != -1) ? 1 : 0;
		var sharp = (note.search(/#/) != -1) ? 1 : 0;
		
		for(var i in dub) {
			note = dub[i];
		
		
			var rest = '';
			if(sharp || flat) {
				rest = note.substr(2, note.length - 2);
				note = note.substr(0, 2);
			} else {	
				rest = note.substr(1, note.length - 1);
				note = note.substr(0, 1);
			}
		
			var num = numbers[note];
			var new_num = num + diff;
		
		
			if(new_num > 11) {
				new_note = notes[new_num - 12];
			} else if(new_num < 0) {
				new_note = notes[12 + new_num];
			} else {
				new_note = notes[new_num];
			}
			
			dub[i] = new_note + rest;
		}
	
		return dub.join('/');
	}
	
	$('.delete-song').click(function(e) {
		e.preventDefault();
		var win = $(window);
		var $this = $(this);
		var dialog = $('#delete-dialog');
		dialog.show();
		dialog.find('.content a').attr('href', 'delete_song.php?file=' + $this.attr('data-file'));
		dialog.find('.content h3').text('Are you sure you want to delete "'+ $this.parents('td').siblings('td').text() + '"?');
		$('#dialog-overlay').show().height(win.height()).width(win.width());
	});
	
	function whichSong(string) {
		var list = string.split(',');
		var box = $('#box #which-song tbody');
		
		box.find('tr').remove();
		
		for(var i = 0; i < list.length - 1; i++) {
			var title = list[i].split('.')[0].split('_').join(' ').capitalize();
			box.append('<tr><td width="430"><span>' + title + '</span></td><td width="45"><button data-file="' + list[i] + '" class="button" type="submit"> \
				<img style="position: relative; left: 3px" alt="Save" src="images/icons/tick.png"></button></td></tr>');
		}
		
		box.find('button').click(function() {
			appendFrame($(this).attr('data-file').split('.')[0]);
			$('#which-song').hide();
			$('#dialog-overlay').hide();
		});
		
		var win = $(window);
		
		$('#which-song').show();
		$('#dialog-overlay').show().height(win.height()).width(win.width());
	}
	
	$('#browse-songs .button').click(function() {
		$('#browse-songs').hide();
		$('#dialog-overlay').hide();
		appendFrame($(this).attr('data-file').split('.')[0]);
	});	
	
	$('#open-browser').click(function() {
		var win = $(window);
		$('#browse-songs').show();
		$('#dialog-overlay').show().height(win.height()).width(win.width());	
	});
	
	$('.close-dialog').click(function() {
		$(this).parents('.block').hide();
		$('#dialog-overlay').hide();
	});
	
	String.prototype.capitalize = function(){
		return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase(); } );
	};

});