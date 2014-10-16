<?php require( 'partials/head.php' ) ?>
    <?php
    require( 'partials/header.php' );

    $message = '404';
    require( 'partials/empty.php' );

    wp_footer();
    if ( get_theme_mod( 'zero_footer_code' ) ) {
      echo get_theme_mod( 'zero_footer_code' );
    }
    ?>
  </body>
</html>