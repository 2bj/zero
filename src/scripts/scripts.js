( function( $, window, document, undefined ) {


  $( '.grid__row' ).photosetGrid({
    gutter: '10px',
  });

  if ( $( '.mosaic__wrapper' ).length ) {
    $( '.mosaic__wrapper' ).masonry( {
      itemSelector: '.mosaic__item',
      columnWidth: 330,
      isFitWidth: true
    } );
  }


  $( '.post__content iframe[src*="soundcloud"]' )
    .parents( 'p' )
    .addClass( 'soundcloud' );


  $( '.post__content' ).fitVids();


  $( '.syntaxhighlighter' )
    .parent( 'div' )
    .addClass( 'code' );

  var $a,
    aAlt,
    aSrc,
    aFilename;

  $( '.slider' )
    .fotorama( {
      'nav': 'thumbs',
      'thumbwidth': 76,
      'thumbheight': 76,
      'thumbmargin': 10,
      'thumbborderwidth': 0,
      'margin': 10,
      'glimpse': 0,
      'navposition': 'bottom',
      'shadows': false,
      'width': '100%',
      'ratio': 1.5,
      'loop': true
    } );

  if ( $( '.search__field' ).val() ) {

    $( '.search__field' )
      .parents( '.search' )
      .find( '.search__label' )
      .addClass( 'search__label--hidden' )
  }

  $( '.search' )
    .on( 'click', '.search__label', function() {
      $( this )
        .addClass( 'search__label--hidden' )
        .parents( '.search' )
        .find( '.search__field' )
        .addClass( 'search__field--visible' )
        .focus();

    } ).on( 'blur', '.search__field', function() {

      if ( !$( this ).val() ) {
        $( this )
          .removeClass( 'search__field--visible' )
          .parents( '.search' )
          .find( '.search__label' )
          .removeClass( 'search__label--hidden' );
      }
    } ).find( '.search__field' ).autoGrowInput( {
      comfortZone: 40,
      minWidth: 10,
      maxWidth: 960
    } );


} )( jQuery, window, document );