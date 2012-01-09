$(function() {
	
	$('form').submit(function(e) {
		
	
	});
	
	$('#submit-login').click(function(e) {
		e.preventDefault();


		$.ajax({
			type: 'POST',
			url: 'check_login.php',
			data: 'user=' + $('#username').val() + '&pw=' + $('#password').val(),
			dataType: 'text',
			success: function(response) {
				if(response == 'success') {
					window.location = 'index.php';
				}
			}
		})
	});
	
});