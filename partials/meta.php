    <div class="meta">
      <div class="meta__date">
        <div class="date">
          <?php echo render_date( get_the_date() ); ?>
        </div>
      </div>
      <div class="meta__tags">
        <ul class="links">
          <?php
          $tags = get_the_tags();
          if ( ! empty( $tags ) ) {
            foreach ( $tags as $tag ) {
              echo '<li class="links__item"><a class="links__link" href="' . get_tag_link( $tag->term_id ) . '" title="' . $tag->name . '">' . $tag->name . '</a></li>';
            }
          }
          ?>
        </ul>
      </div>
    </div>