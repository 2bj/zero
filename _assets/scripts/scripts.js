;
( function( $, window, document, undefined ) {

	/**
	 * Фоторама
	 */
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



	$( '.share' )
		.on( 'mouseenter', function() {
			if ( $( window ).width() <= 720 ) {
				$( this )
					.parents( '.post' )
						.find( '.post__title ' )
							.css({
								opacity: 0
							});
			}
		} )
		.on( 'mouseleave', function() {
			if ( $( window ).width() <= 720 ) {
				$( this )
					.parents( '.post' )
						.find( '.post__title ' )
							.css({
								opacity: 1
							});
			}
		} );

} )( jQuery, window, document );