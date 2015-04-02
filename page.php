<?php get_header();?>
<div id="main">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article class="page" itemscope itemtype="http://schema.org/Article">
    <header class="post-head">
      <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
    </header>
    <div class="post-content" itemprop="articleBody">
      <?php the_content(); ?>
    </div>
  </article>
  <?php endwhile; endif; ?>
  <div id="comments"><?php comments_template('', true); ?></div>
</div>
<?php get_footer();?>