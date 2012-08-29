/*!
*
*	ajaxAppend v1.0 - a jQuery Plugin by Tyler Benziger
*	http://tylerbenziger.github.com/ajaxAppend
* 	
*	Copyright 2012, Tyler Benziger
*
*	Date: Tuesday June 26, 2012 09:47AM
*
*/

(function( $, undefined ){	
	$.fn.ajaxAppend = function( options ) {
		var settings = $.extend({
			templates: [ { template: '<p>{{data.text}}</p>', selector: 'body', order: 'append' } ],
			dataName: 'data',
			dataCollection: false,
			formReset: true,
		}, options );
		
		this.bind( "ajaxSuccess", function( evt, xhr ) {
      console.log(xhr.responseText);
			var response = JSON.parse( xhr.responseText ),
				templates = settings.templates;
			
			for ( var idx in templates ) {
				var template = templates[ idx ].template,
					selector = templates[ idx ].selector,
					order = templates[ idx ].order,
					callback = templates[ idx ].callback,
					data = {};
					
				data[ settings.dataName ] = response;
				var $newEle = $( _.template( template, data ) );
				
				switch ( order ) {
					case 'before':
						$( selector ).before( $newEle );
						break;
					case 'after':
						$( selector ).after( $newEle );
						break;
					case 'prepend':
						$( selector ).prepend( $newEle );
						break;
					case 'replace':
						$( selector ).replaceWith( $newEle );
						break;
					case 'append':
					default:
						$( selector ).append( $newEle );
						break;
				}
				
				if ( callback ) {
					callback.call( $newEle );
				}
			}
			
			if ( settings.formReset ) {
				$( this )[0].reset();
			}
		});		
	};
	
})( jQuery );
