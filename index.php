<?php get_header();?>
<div id="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>
  <?php endwhile; endif; ?>      

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