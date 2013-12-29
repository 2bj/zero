jQuery( function( $ ) {

	if ( $( 'div#of_post_cover' ).length ) {

		coverOptions( $( 'input[name="of_cover_type"]:checked' ).val() );

		$( 'input[name="of_cover_type"]' ).on( 'change', function() {
			coverOptions( $( this ).val() );
		} );

	}

	function coverOptions( val ) {

		if ( val == 'cover' ) {
			$( 'textarea#of_lead, input[name="of_color[]"], input[name="of_shares"]' )
				.parents( 'tr' )
				.show();
		} else {
			$( 'textarea#of_lead, input[name="of_color[]"], input[name="of_shares"]' )
				.parents( 'tr' )
				.hide();
		}

		if ( val != 'none' ) {
			$( '#postimagediv' )
				.show();
		} else {
			$( '#postimagediv' )
				.hide();
		}
	}

} );