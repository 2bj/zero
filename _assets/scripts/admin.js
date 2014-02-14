jQuery( function( $ ) {

	$('.colorpicker').wpColorPicker();

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


jQuery(function(jQuery) {

	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function( html ) {
			html = jQuery( jQuery.parseHTML( html ) );
			imgurl = html.attr('src');
			console.log( imgurl );
			classes = html.attr('class');
			id = classes.replace( /(.*?)wp-image-/, '' );
			formfield.val( id );
			preview.attr( 'src', imgurl );
			tb_remove();
		}
		return false;
	});

	jQuery( '.custom_clear_image_button' ).click( function() {
		var defaultImage = jQuery( this ).parent().siblings( '.custom_default_image' ).text();
		jQuery( this ).parent().siblings( '.custom_upload_image' ).val( '' );
		jQuery( this ).parent().siblings( '.custom_preview_image' ).attr( 'src', defaultImage );
		return false;
	});

});


