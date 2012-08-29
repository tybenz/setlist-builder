var Builder = {};
window.Builder = Builder;

Builder.songCount = 1;

$(function() {
	Builder.init();

  $('#add-song-form').on( 'submit', function( evt ) {
    evt.preventDefault();
    $.ajax({
      url: 'find_song.php',
      data: $(this).serialize(),
      type: 'post'
    });
  });
});

//before%#setlist tbody tr:last|#song-list

Builder.init = function() {
	// Tweak underscore's template settings - originals conflict with ERB
	_.templateSettings = {
	 	evaluate: /\{\%(.+?)\%\}/g,
		interpolate: /\{\{(.+?)\}\}/g
	};
	
	// Create templates array for ajaxAppend Plugin
	var templates = [
		{
			template: $( "#row-template" ).text(),
			selector: 'tbody tr:last',
			order: 'before',
			callback: function() {
				var $row = this;
				this.find( '.remove-song' ).click( function( evt ) {
					evt.preventDefault();
					Builder.removeSong.call( $row )
				});
			}
		},
		{
			template: $( "#song-template" ).text(),
			selector: '#main',
			callback: function() {
				var id = this.find( 'pre' ).attr( 'id' )
				$( '.key-select[data-song=' + id + ']' ).keylister();
				$( '.capo-select[data-song=' + id + ']' ).keylister( capo = true );
				Builder.songCount++;
			}
		}
	];
	
	$( "#add-song-form" ).ajaxAppend({ dataName: 'songs', templates: templates });
};

Builder.removeSong = function( $row ) {
	var id = this.find( '.key-select' ).attr( 'data-song' ),
		num = parseInt( this.find( 'td:first' ).text() );
	
	$( '#setlist tr:gt(' + num + ')' ).each( function() {
		var $this = $( this ).find( 'td:first' ),
			val = parseInt( $this.text() ),
			str = val - 1 ? val - 1 + '.' : '';
		
		$this.text( str );
	});

	this.remove();
	$( '#' + id ).closest( '.song' ).remove();
	
	Builder.songCount--;
};
