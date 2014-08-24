<?php if ( !isset( $mosaic ) ) : ?>

  <div class="pagination pagination--desktop">
    <?php
    global $wp_query, $wp_rewrite;
    $max_num_pages = $wp_query->max_num_pages;
    echo paginate_links( array(
      'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
      'total'     => $max_num_pages,
      'current'   => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
      'mid_size'  => 2,
      'end_size'  => 1
     ) );
    ?>
  </div>

  <div class="pagination pagination--mobile">
    <?php
    global $wp_query, $wp_rewrite;
    $max_num_pages = $wp_query->max_num_pages;
    echo paginate_links( array(
      'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
      'total'     => $max_num_pages,
      'current'   => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
      'mid_size'  => 1,
      'end_size'  => 1
     ) );
    ?>
  </div>

<?php endif; ?>