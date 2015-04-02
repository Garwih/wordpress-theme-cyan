<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <header class="post-head">
    <?php if ( is_single() ) : 
      the_title( sprintf( '<h1 class="post-title" itemprop="headline"><a href="%s" class="icon-link" rel="nofollow">', esc_url( mytheme_get_link_url() ) ), '</a></h1>' );
    ?>
      <time class="post-date" itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
    <?php else :
      the_title( sprintf( '<h2 class="post-title" itemprop="headline"><a href="%s" class="icon-link" rel="nofollow">', esc_url( mytheme_get_link_url() ) ), '</a></h2>' );
    ?> 
      <time class="post-date fn-hide" itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
    <?php endif; // is_single() 
    ?>
  </header>
  <div class="post-content typo"><?php the_content(); ?></div>
  <footer class="post-foot">
    <?php if ( is_single() ) : ?>
      <div class="post-tags" itemprop="keywords"><?php the_tags('#','#'); ?></div>
    <?php else : ?>
        <?php comments_popup_link( "0 comments", "1 comment", "% comments", "comments-link", "Comments Off" ); ?>
        <a href="<?php the_permalink(); ?>" class="more-link" rel="bookmark nofollow">Read more &gt;&gt;</a>
    <?php endif; ?>
  </footer>
</article>