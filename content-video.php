<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <header class="post-head">
    <?php if ( is_single() ) : ?>
      <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
    <?php else : ?>
      <h2 class="post-title fn-hide" itemprop="headline">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h2>
    <?php endif; // is_single() ?>
      <time class="post-date icon-video" itemprop="datePublished" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
  </header>
  <div class="post-content typo" itemprop="articleBody"><?php the_content(); ?></div>
  <footer class="post-foot">
    <?php if ( is_single() ) : ?>
      <div class="post-tags" itemprop="keywords"><?php the_tags('#','#'); ?></div>
    <?php else : ?>
        <?php comments_popup_link( "0 comments", "1 comment", "% comments", "comments-link", "Comments Off" ); ?>
        <a href="<?php the_permalink(); ?>" class="more-link" rel="bookmark nofollow">Read more &gt;&gt;</a>
    <?php endif; ?>
  </footer>
</article>