<?php get_header();?>
<div id="main">
    <header class="page-head">
        <h1 itemprop="headline">
            <?php if ( is_tag() ) : ?>
                <?php printf( __( '标签: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
            <?php elseif ( is_category() ) : ?>
                <?php printf( __( '分类: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
            <?php else : ?>
                <?php _e( 'Blog Archives' ); ?>
            <?php endif; ?>
        </h1>
    </header>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; endif; ?>      

<!-- Nav -->
  <nav class="page-nav">
    <?php
      global $wp_query;
      echo '<p class="pages">第 '.max( 1, get_query_var('paged') ).' 页，共 '.$wp_query->max_num_pages.' 页</p>';
      if ( $wp_query->max_num_pages > 1 ){
        $big = 999999999;
        echo paginate_links(array(
          'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'current'   => max( 1, get_query_var('paged') ),
          'prev_text' => '&laquo;',
          'next_text' => '&raquo;',
          'total'     => $wp_query->max_num_pages
        ));
      }
    ?>
  </nav>
</div>
<?php get_footer();?>