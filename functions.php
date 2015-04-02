<?php

remove_action('wp_head', 'rsd_link');
remove_action('wp_head','feed_links',2);
remove_action('wp_head','feed_links_extra',3);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head',10,0 );
remove_filter('the_content', 'wptexturize');
remove_filter('the_content','capital_P_dangit',11);
remove_filter('the_title','capital_P_dangit',11);
remove_filter('wp_title','capital_P_dangit',11);
remove_filter('comment_text','capital_P_dangit',31);

// 移除后台 Google Font API
function remove_open_sans_from_wp_core() {
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', FALSE);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans_from_wp_core');

// 加载主题的 CSS 和 JS
if (!is_admin()) {
  function scripts_method() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', 'all', '13.46' );
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', '//upcdn.b0.upaiyun.com/libs/jquery/jquery-1.10.2.min.js', array(), '1.10.2', true);
    wp_enqueue_script( 'all', get_template_directory_uri().'/js/all.js', array(), '1.0', true);
    if ( is_singular() ) {
      wp_enqueue_script('comments_ajax_js', get_template_directory_uri().'/comments-ajax.js', false, '1.3', true);
    }
  }
}
add_action( 'wp_enqueue_scripts', 'scripts_method' );

// 使用 多说 Gravatar 镜像
function duoshuo_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'duoshuo_avatar', 10, 3 );

// Link Post
if ( ! function_exists( 'mytheme_get_link_url' ) ){
  function mytheme_get_link_url() {
    $has_url = get_url_in_content( get_the_content() );
    return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
  }
}

// 注册导航菜单
if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array('top' => '头部导航栏'));
}

// 自定义主导航
if ( ! function_exists( 'theme_main_nav' ) ):
function theme_main_nav(){
  $menu_name = 'top';

  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    if ($menu_items) {
      foreach ( (array) $menu_items as $key => $menu_item ) {
          $title = $menu_item->title;
          $url = $menu_item->url;
          $menu_list .= '<a href="' . $url . '">' . $title . '</a>';
      }
    } else {
      $menu_list = '<a href="'.esc_url( home_url( '/' ) ).'">Home</a>';
    }
  } else {
    $menu_list = '<a href="'.esc_url( home_url( '/' ) ).'">Home</a>';
  }
  echo $menu_list;
}
endif;

// 删除默认 Read More 链接
function del_more() {
	return "";
}
add_filter( 'the_content_more_link', 'del_more' );

// 文章形式
add_theme_support( 'post-formats', array( 'aside','link','image','status','video','audio' ) );

// 评论 [img] 标签显示为图片 
function embed_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
  return $content;
}
add_filter('comment_text', 'embed_images');

//自定义评论表情
if ( !isset( $wpsmiliestrans ) ) {
    $wpsmiliestrans = array(
    ':mrgreen:' => 'icon_mrgreen.gif',
    ':neutral:' => 'icon_neutral.gif',
    ':twisted:' => 'icon_twisted.gif',
      ':arrow:' => 'icon_arrow.gif',
      ':shock:' => 'icon_eek.gif',
      ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
       ':cool:' => 'icon_cool.gif',
       ':evil:' => 'icon_evil.gif',
       ':grin:' => 'icon_biggrin.gif',
       ':idea:' => 'icon_idea.gif',
       ':oops:' => 'icon_redface.gif',
       ':razz:' => 'icon_razz.gif',
       ':roll:' => 'icon_rolleyes.gif',
       ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':eek:' => 'icon_surprised.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':see:' => 'icon_see.gif',
        ':!!!:' => 'icon_exclamation.gif',
        ':ymy:' => 'icon_youmuyou.gif',
        ':sbq:' => 'icon_sbq.gif',
         ':sx:' => 'icon_shaoxiang.gif',
         ':gl:' => 'icon_gl.gif',
        ':bgl:' => 'icon_bgl.gif',
        ':kbz:' => 'icon_kbz.gif',
        ':gg:' => 'icon_gg.gif',
          '8-)' => 'icon_cool.gif',
          '8-O' => 'icon_eek.gif',
          ':-(' => 'icon_sad.gif',
          ':-)' => 'icon_smile.gif',
          ':-?' => 'icon_confused.gif',
          ':-D' => 'icon_biggrin.gif',
          ':-P' => 'icon_razz.gif',
          ':-o' => 'icon_surprised.gif',
          ':-x' => 'icon_mad.gif',
          ':-|' => 'icon_neutral.gif',
          ';-)' => 'icon_wink.gif',
           '8)' => 'icon_cool.gif',
           '8O' => 'icon_eek.gif',
           ':(' => 'icon_sad.gif',
           ':)' => 'icon_smile.gif',
           ':?' => 'icon_confused.gif',
           ':D' => 'icon_biggrin.gif',
           ':P' => 'icon_razz.gif',
           ':o' => 'icon_surprised.gif',
           ':x' => 'icon_mad.gif',
           ':|' => 'icon_neutral.gif',
           ';)' => 'icon_wink.gif',
          ':!:' => 'icon_exclaim.gif',
          ':?:' => 'icon_question.gif',
    );
}

function custom_smilies_src($src, $img){
    return get_bloginfo('template_directory').'/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

// 回复自动添加 @评论者
function comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }
  return $comment_text;
}
add_filter( 'comment_text' , 'comment_add_at', 20, 2);

/* comment_mail_notify v1.0 by willin kan. (有勾选栏, 由访客決定) */
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . nl2br(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回复:<br />'
       . nl2br($comment->comment_content) . '<br /></p>
      <p>您可以点击<a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复完整內容</a></p>
      <p>欢迎再度光临<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发出, 请勿回复！.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

/* 自动勾选 */
function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" />
<label for="comment_mail_notify">接收回复邮件通知</label>';
}
add_action('comment_form', 'add_checkbox');

// -- END ----------------------------------------

// 自定义 title
function theme_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
        }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'theme_name_wp_title', 10, 2);

// 自定义评论结构
function mytheme_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    global $commentcount;
    $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );
    $cpp=get_option('comments_per_page');
    if(!$commentcount) {
        if ($page > 1) {
            $commentcount = $cpp * ($page - 1);
        } else {
            $commentcount = 0;
        }
    }
?>
    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="li-comment-<?php comment_ID(); ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
        <?php if( !$parent_id = $comment->comment_parent){ ?>
        <div id="comment-<?php comment_ID(); ?>" class="comment-main">
            <div class="comment-avatar">
                <?php echo get_avatar($comment,$size='48',$default='' ); ?>
            </div>
            <div class="comment-content">
                <div class="comment-entry">
                  <span class="comment-author" itemprop="author">
                    <?php comment_author_link(); ?>
                  </span>
                  <div class="comment-text" itemprop="description">
                    <?php comment_text(); ?>
                  </div>
                  <span class="floor"><?php printf('#%1$s', ++$commentcount); ?></span>
                </div>
                <div class="comment-meta">
                  <time class="reply-time" datetime="<?php comment_time('c'); ?>" itemprop="datePublished"><?php comment_time('Y/m/d H:i'); ?></time>
                  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], "reply_text" =>"回复"))); ?>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div id="comment-<?php comment_ID(); ?>" class="comment-sub">
            <div class="comment-avatar">
                <?php echo get_avatar($comment,$size='36',$default='' ); ?>
            </div>
            <div class="comment-content">
                <div class="comment-entry">
                  <span class="comment-author" itemprop="author">
                    <?php comment_author_link(); ?>
                  </span>
                  <div class="comment-text" itemprop="description">
                    <?php comment_text(); ?>
                  </div>
                </div>
                <div class="comment-meta">
                  <time class="reply-time" datetime="<?php comment_time('c'); ?>" itemprop="datePublished"><?php comment_time('Y/m/d H:i'); ?></time>
                  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], "reply_text" =>"回复"))); ?>
                </div>
            </div>
        </div>
        <?php } ?>
<?php }

?>