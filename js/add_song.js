$(function() {

	$('.key').click(function() {
		$('.key').removeClass('active');
		$(this).addClass('active');
	});
	
	$('#add-song').keypress(function(e) {
		if(e.metaKey && e.which == 98) {
			
			e.preventDefault();
			
			var string = getSelection($('#add-song'));
			string_array = string.split('');
			
			var open_tag = 0;
			for(var i in string_array) {
				if(open_tag) {
					if(string_array[i] == ' ' || string_array[i] == ')') {
						string_array[i] = '</b>' + string_array[i];
						open_tag = 0;
					}
				} else {
					if(string_array[i] != " " && string_array[i] != '(') {
						string_array[i] = '<b>' + string_array[i];
						open_tag = 1;
					}
				}
			}
			
			if(open_tag) {
				var i = string_array.length - 1;
				string_array[i] = string_array[i] + '</b>';
			}
			
			var new_array = [];
			
			replaceIt($('#add-song').get(0), string_array.join(''));
			
			
		}
	});
	
	$('#submit-new-song').click(function() {
		$.ajax({
			type: 'POST',
			url: 'write_song.php',
			data: 'chords=' + $('#add-song').val() + '&title=' + $('#song-title').val() + '&key=' + $('.key.active').text(),
			success: function() {
				$('#submit-new-song').after('<span style="margin-left: 10px; color: #0d0">Success!</span>');
			},
			error: function() {
				$('#submit-new-song').after('<span style="margin-left: 10px; color: #d00">Try Again</span>');
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
	
});