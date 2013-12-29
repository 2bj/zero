;
( function( $, window, document, undefined ) {

	$( '.slider' )
		.find( 'img' ).each( function() {
			$( this ).data( 'caption', $( this ).attr( 'alt' ) );
		} )
		.parents( '.slider' )
		.fotorama( {
			'arrows': false,
			// 'loop': true,
			'margin': 1,
			'glimpse': 0,
			'navposition': 'top',
			'shadows': false,
			'width': '100%',
			'maxheight': 640
		} );


} )( jQuery, window, document );