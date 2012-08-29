/*!
*
*	Key Selector v1.0 - a jQuery Plugin by Tyler Benziger
*	http://caltab.github.com/transposer
* 	
*	Copyright 2012, Tyler Benziger
*
*	Date: Monday June 25, 2012 11:06AM
*
*/

(function( $, undefined ){

var numbers = { 'Ab': 11, 'A': 0, 'A#': 1, 'Bb': 1, 'B': 2, 'C': 3, 'C#': 4, 'Db': 4, 'D': 5, 'D#': 6, 'Eb': 6, 'E': 7, 'F': 8, 'F#': 9, 'Gb': 9, 'G': 10, 'G#': 11 },
	notes = {
		sharps: [ 'A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#' ],
		flats: [ 'A', 'Bb', 'B', 'C', 'Db', 'D', 'Eb', 'E', 'F', 'Gb', 'G', 'Ab' ]
	},
	chordRegex = /\b([A-G][b\#]?(2|5|6|7|9|11|13|6\/9|7\-5|7\-9|7\#5|7\#9|7\+5|7\+9|7b5|7b9|7sus2|7sus4|add2|add4|add9|aug|dim|dim7|m\/maj7|m6|m7|m7b5|m9|m11|m13|maj7|maj9|maj11|maj13|mb5|m|sus|sus2|sus4)*)(?=[^A-z])/g,
	transpose = function( newKey, oldKey, note ) {
		//This function takes in a chord (it can be complex e.g. G/F#)
		//It shifts the chord according to some offset and returns the result
		var dub = note.split('/');

		for ( var idx in dub ) {
			var notesArr = newKey.match( /b/g ) ? notes.flats : notes.sharps,
				regex = /([A-G])?(b|#)?(.*)?/g,
				extra = dub[ idx ].replace( regex, '$3' ),
				root_note = dub[ idx ].replace( regex, '$1$2' ),
				new_num = numbers[ root_note ] + ( numbers[ newKey ] - numbers[ oldKey ] ),
				new_note = new_num >= 0 ? notesArr[ new_num % 12 ] : notesArr[ new_num + 12 ];

			dub[ idx ] = new_note + extra;
		}

			return dub.join('/');
	};

$.fn.keySelector = function( isCapo ) {
	return this.each( function() {		
		var $widget = $( this ),
			key = $widget.attr( 'data-key' ),
			capo = $widget.attr( 'data-capo' ),
			title = $widget.attr( 'data-song' ),
			$song = $( '#' + $widget.attr( 'data-song' ) ),
			$songHeader = $( '[data-header=' + $widget.attr( 'data-song' ) + ']' ),
			$keyBtns = '';

		if ( isCapo ) {
			$widget.bind( 'change', function() {
				console.log('Capo: ' + parseInt($(this).val()));
				var val = parseInt( $( this ).val() ),
					str = ( val == 0 ) ? '' : ( 'Capo: ' + val ),
					$capo = $songHeader.find( ".capo" );
					
				if ( !$capo.length ) {
					$songHeader.append( '<span class="capo">' + str + '</span>' );
				} else {
					$capo.text( str );
				}
			});
		} else {
			// Inject the key buttons
			for ( var idx in numbers ) {
				$keyBtns += '<a href="#"' + ( idx == key ? ' class= "active"' : '' ) + '>' + idx + '</a>';
			}
			$keyBtns = $widget.append( $keyBtns + '<br style="clear: both" />' );

			// Wrap chords with strong tag plus a whitespace
			$song.html( $song.text().replace( chordRegex, '<strong>$1 </strong>').replace( /<\/strong> /g, '</strong>' ) );

			// Bind key buttons to transpose the song
			$keyBtns.find('a').bind( 'click', function( evt ) {
				evt.preventDefault();

				var $this = $( this ),
					newKey = $this.text(),
					oldKey = $widget.data( 'key' );
				$song.find( 'strong' ).each( function() {
					var $this = $( this ),
						oldChord = $this.text(),
						newChord = transpose( newKey, oldKey, $.trim( oldChord ) ) + ' ';
			
					// Return the new chord with the correct amount of trailing whitespace
					$this.text( oldChord.length > newChord.length ? newChord + '  ' : ( oldChord.length < newChord.length ? $.trim( newChord ) : newChord ) );
				});
				// Apply active class to button just clicked
				$this.siblings().removeClass( 'active' );
				$this.addClass('active');
				$widget.data( 'key', newKey );
			});
		}
	});
};

})( jQuery );