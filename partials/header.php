    <header class="header">
      <div class="header__logo">
        <a href="<?php echo get_bloginfo('url') ?>/" title="<?php echo __( 'To home page', 'zero' ) ?>" class="logo"><?php echo get_bloginfo( 'name' ) ?></a>
      </div>
      <div class="header__nav">
        <?php
        $defaults = array(
          'menu'        => 'primary',
          'menu_class'  => 'nav'
        );
        wp_nav_menu( $defaults );
        ?>
      </div>
      <div class="header__search">
        <form action="<?php echo get_bloginfo('url') ?>/" method="get" name="search" class="search">
          <label for="s" class="search__label"><?php echo __( 'Search', 'zero' ) ?></label>
          <input type="text" name="s" id="s" class="search__field" value="<?php echo ( isset( $_GET['s'] ) && $_GET['s'] ? $_GET['s'] : '' ) ?>">
        </form>
      </div>
    </header>