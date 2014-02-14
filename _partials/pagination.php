<div class="pagination">
<?php
global $wp_query, $wp_rewrite;
$max_num_pages = $wp_query->max_num_pages;
echo paginate_links( array(
  'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
  'total'     => $max_num_pages,
  'current'   => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
  'mid_size'  => 5,
  'end_size'  => 1
 ) );
?>
</div>