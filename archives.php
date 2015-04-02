<?php
/*
Template Name: Archives
*/
?>
<?php get_header();?>
<div id="main">
  <article class="page" class="archives" itemscope itemtype="http://schema.org/Article">
    <header class="post-head">
      <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
    </header>
    <?php 
      $output = '<div class="archives-list" itemprop="articleBody">';
      $args = array(
        'post_type' => 'post', //如果你有多个 post type，可以这样 array('post', 'product', 'news')  
        'posts_per_page' => -1, //全部 posts
        'ignore_sticky_posts' => 1 //忽略 sticky posts
      );
      $the_query = new WP_Query( $args );
      $posts_rebuild = array();
      $year = $mon = 0;
      while ( $the_query->have_posts() ) : $the_query->the_post();
        $post_year = get_the_time('Y');
        $post_mon = get_the_time('m');
        $post_day = get_the_time('d');
        if ($year != $post_year) $year = $post_year;
        if ($mon != $post_mon) $mon = $post_mon;
        $posts_rebuild[$year][$mon][] = '<li><time>'. get_the_time('d日: ') .'</time><a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>';
      endwhile;
      wp_reset_postdata();

      foreach ($posts_rebuild as $key_y => $y) {
        foreach ($y as $key_m => $m) {
          $posts = ''; $i = 0;
          foreach ($m as $p) {
            ++$i;
            $posts .= $p;
          }
          $output .= '<h2>'. $key_y .' 年 '. $key_m .'月 ( '. $i .' 篇文章 )</h2>';
          $output .= '<ul class="posts-list">';
          $output .= $posts; //输出 posts
          $output .= '</ul>';
        }
      }

      echo $output .= '</div>';
    ?>
  </article>
</div>
<?php get_footer();?>