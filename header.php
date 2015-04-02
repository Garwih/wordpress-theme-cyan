<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title itemprop="name"><?php wp_title('|',true,right); ?></title>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/html5.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/css3-mediaqueries.js"></script>
  <![endif]-->
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>">
  <?php wp_head(); ?>
</head>
<body>
  <div id="page">
    <header id="head">
      <div class="site-brand">
      <?php
        if ( is_front_page() && is_home() ) : ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php else : ?>
          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php endif;

        $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : 
          if ( is_front_page() && is_home() ) : ?>
            <h2 class="site-description"><?php echo $description; ?></h2>
          <?php else : ?>
            <p class="site-description"><?php echo $description; ?></p>
          <?php endif; ?>
        <?php endif;
      ?>
      </div>
      <div class="nav-bar">
        <nav class="main-nav">
          <?php theme_main_nav() ?>
        </nav>
        <a href="#" class="main-nav-menu icon-menu"></a>
      </div>
    </header>