<?php require( 'partials/head.php' ) ?>

    <?php

    $fb_like = trim( get_theme_mod( 'zero_og_fb_like' ) );
    if ( $fb_like ) {
      echo str_replace( 'ru_RU', 'en_GB', $fb_like );
    }
    ?>

    <?php
    require( get_stylesheet_directory().'/partials/header.php' );

    if ( $is_mosaic ) {

      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tag_slug__in' => array( $current_tag )
      );
      $mosaic = new WP_Query( $args );

      if ( $mosaic->have_posts() ) {
        echo '<section class="mosaic"><div class="mosaic__wrapper">';
        $i = 1;
        while ( $mosaic->have_posts() ) {
          $mosaic->the_post();

          require( 'partials/mosaic_item.php' );
          $i++;
        }
        echo '</div></section>';
      } else {
        $message = __( 'No posts', 'zero' );
        require( 'partials/empty.php' );
      }

    } else {

      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post();
          require( 'partials/post.php' );

          if ( is_single() ) {
            require( 'partials/meta.php' );
            require( 'partials/comments.php' );
          }
        }
      } else {
        $message = __( 'No posts', 'zero' );
        require( 'partials/empty.php' );
      }
    }

    if ( !is_single() ) {
      require( 'partials/footer.php' );
    }
    wp_footer();
    if ( get_theme_mod( 'zero_footer_code' ) ) {
      echo get_theme_mod( 'zero_footer_code' );
    }
    ?>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </body>
</html>


<?php

