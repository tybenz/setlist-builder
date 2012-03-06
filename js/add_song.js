$(function() {
	
	var notes = ["A", "Bb", "B", "C", "C#", "D", "Eb", "E", "F", "F#", "G", "G#"];
	var numbers = {"A": 0, "Bb": 1, "B": 2, "C": 3, "C#": 4, "D": 5, "Eb": 6, "E": 7, "F": 8, "F#": 9, "G": 10, "G#": 11};
	
	$('.key').click(function() {
		$(this).siblings('.key').removeClass('active');
		$(this).addClass('active');
	});
	
	for(var i = 0; i < ($('#add-song-margin').height() / 16); i++) {
		$('#add-song-margin').append('<div class="line-marker"></div>');
	}
	
	$('.line-marker').click(function() {
		var $this = $(this);
		
		if($this.hasClass('selected')) {
			$this.removeClass('selected');
		} else {
			$this.addClass('selected');
		}
	});
	
	var win = $(window);
	
	var song_to_submit = '';
	
	$('#select-key').click(function() {
		var song = $('#add-song').val();
		var array = song.split("\n");
		
		$('.line-marker.selected').each(function() {
			var string = array[$(this).index()];
			
			var string_array = string.split('');
			
			var open_tag = 0;
			var skip = 0;
			for(var i in string_array) {
				if(string_array[i].indexOf('[') != -1) {
					skip = 1;
				}
				if(!skip) {
					if(open_tag) {
						if(string_array[i].match(/\s/) || string_array[i] == ')') {
							string_array[i] = '</strong>' + string_array[i];
							open_tag = 0;
						}
					} else {
						if(string_array[i].match(/\S/) && string_array[i] != '(') {
							string_array[i] = '<strong>' + string_array[i];
							open_tag = 1;
						}
					}
				}
				if(string_array[i].indexOf(']') != -1) {
					skip = 0;
				}
			}
			
			if(open_tag) {
				var i = string_array.length - 1;
				string_array[i] = string_array[i] + '</strong>';
			}
			
			array[$(this).index()] = string_array.join('');
			
		});
		
		
		song_to_submit = array.join('\n');
		
		$('#keys').show();
		$('#dialog-overlay').show().height(win.height()).width(win.width());
	});
	
	$('#close-dialog').click(function() {		
		$('#keys').hide();
		$('#dialog-overlay').hide();
	});
	
	$('#submit-new-song').click(function() {
		var default_key = $('#default-key .key.active').text();
		var current_key = $('#current-key .key.active').text();
		
		if(default_key != current_key) {
			//change key before adding
			
			var diff = numbers[default_key] - numbers[current_key];
			
			var song = $('<div>' + song_to_submit + '</div>');
			
			song.find('strong').each(function() {
				$(this).text(transpose(diff, $(this).text()));
			});
			
			song_to_submit = song.html();
		}
		
		$.ajax({
			type: 'POST',
			url: 'write_song.php',
			data: 'chords=' + song_to_submit + '&title=' + $('#song-title').val() + '&key=' + $('#default-key .key.active').text(),
			success: function() {
				$('#keys').hide();
				$('#dialog-overlay').hide();
				$('#select-key').after('<span style="margin-left: 10px; color: #0d0">Success!</span>');
			},
			error: function() {
				$('#keys').hide();
				$('#dialog-overlay').hide();
				$('#select-key').after('<span style="margin-left: 10px; color: #d00">Try Again</span>');
			}
		})
	});
	
	
	function replaceIt(txtarea, newtxt) {
	  $(txtarea).val(
	        $(txtarea).val().substring(0, txtarea.selectionStart)+
	        newtxt+
	        $(txtarea).val().substring(txtarea.selectionEnd)
	   );  
	}
	
	function getSelection(txtarea) {
		var txt = txtarea.get(0);
		return txtarea.val().substring(txt.selectionStart, txt.selectionEnd);
	}
	
	function getCaret(node) {
	  if (node.selectionStart) {
	    return node.selectionStart;
	  } else if (!document.selection) {
	    return 0;
	  }

	  var c = "\001",
	      sel = document.selection.createRange(),
	      dul = sel.duplicate(),
	      len = 0;

	  dul.moveToElementText(node);
	  sel.text = c;
	  len = dul.text.indexOf(c);
	  sel.moveStart('character',-1);
	  sel.text = "";
	  return len;
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
});