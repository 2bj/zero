// svg fallback
( function( ) {
	var supportsSVG = !! document.createElementNS && !! document.createElementNS( "http://www.w3.org/2000/svg", "svg" ).createSVGRect;

	if ( !supportsSVG ) { // Fallback for CSS background-images
		var sheets = document.styleSheets;
		if ( sheets ) {
			for ( var i = 0; i < sheets.length; i++ ) {
				var rules = ( sheets[ i ].cssRules ) ? sheets[ i ].cssRules : sheets[ i ].rules;
				for ( var j = 0; j < rules.length; j++ ) {
					var rule = rules[ j ].style;
					if ( rule && rule.backgroundImage ) {
						rule.backgroundImage = rule.backgroundImage.replace( ".svg", ".png" );
					}
				}
			}
		}

		// Fallback for <img> tags
		var imgs = document.getElementsByTagName( 'img' );
		for ( var i = 0; i < imgs.length; i++ ) {
			imgs[ i ].src = imgs[ i ].src.replace( ".svg", ".png" );
		}
	}
} )( );