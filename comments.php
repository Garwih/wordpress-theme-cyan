<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要直接加载该页面，谢谢！');
    if ( post_password_required() ) { ?>

        <p class="nocomments"><?php _e('这篇文章需要密码，请输入密码访问'); ?></p> 

    <?php
        return;
    }
?>



<?php if ( have_comments() ) : ?>

    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=mytheme_comment&max_depth=1000'); ?>
    </ol>

    <div class="pagenavi"><?php paginate_comments_links('prev_text=上一页&next_text=下一页');?></div>

 <?php else :
       if ('open' == $post->comment_status) :
 ?>

    <?php else : ?>

        <p class="nocomments"></p>

    <?php endif; ?>

<?php endif; ?>



<?php if ( comments_open() ) : ?>

<!-- <section id="respond">
    <h3 id="reply-title">发表评论
        <span id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span>
    </h3>
</section> -->
    <!-- <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"> -->

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>

    <p><?php printf(__('你需要 <a href="%s">登录</a> 才可以回复.'), wp_login_url( get_permalink() )); ?></p>

<?php else:

$args =  array(
'comment_field'=> '<p class="clear"></p><p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
<p class="comment-form-expression">
<a href="javascript:grin(\':!!!:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_exclamation.gif" alt="" /></a>
<a href="javascript:grin(\':ymy:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_youmuyou.gif" alt="" /></a>
<a href="javascript:grin(\':sbq:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_sbq.gif" alt="" /></a>
<a href="javascript:grin(\':sx:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_shaoxiang.gif" alt="" /></a>
<a href="javascript:grin(\':gl:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_gl.gif" alt="" /></a>
<a href="javascript:grin(\':bgl:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_bgl.gif" alt="" /></a>
<a href="javascript:grin(\':kbz:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_kbz.gif" alt="" /></a>
<a href="javascript:grin(\':arrow:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_arrow.gif" alt="" /></a>
<a href="javascript:grin(\':lol:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_lol.gif" alt="" /></a>
<a href="javascript:grin(\':smile:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_smile.gif" alt="" /></a>
<a href="javascript:grin(\':gg:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_gg.gif" alt="" /></a>
<a href="javascript:grin(\':?:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_question.gif" alt="" /></a>
<a href="javascript:grin(\':razz:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_razz.gif" alt="" /></a>
<a href="javascript:grin(\':wink:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_wink.gif" alt="" /></a>
<a href="javascript:grin(\':idea:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_idea.gif" alt="" /></a>
<a href="javascript:grin(\':see:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_see.gif" alt="" /></a>
<a href="javascript:grin(\':evil:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_evil.gif" alt="" /></a>
<a href="javascript:grin(\':!:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_exclaim.gif" alt="" /></a>
<a href="javascript:grin(\':oops:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_redface.gif" alt="" /></a>
<a href="javascript:grin(\':grin:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_biggrin.gif" alt="" /></a>
<a href="javascript:grin(\':eek:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_surprised.gif" alt="" /></a>
<a href="javascript:grin(\':shock:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_eek.gif" alt="" /></a>
<a href="javascript:grin(\':???:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_confused.gif" alt="" /></a>
<a href="javascript:grin(\':cool:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_cool.gif" alt="" /></a>
<a href="javascript:grin(\':mad:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_mad.gif" alt="" /></a>
<a href="javascript:grin(\':twisted:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_twisted.gif" alt="" /></a>
<a href="javascript:grin(\':roll:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_rolleyes.gif" alt="" /></a>
<a href="javascript:grin(\':neutral:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_neutral.gif" alt="" /></a>
<a href="javascript:grin(\':cry:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_cry.gif" alt="" /></a>
<a href="javascript:grin(\':mrgreen:\')"><img src="/wp-content/themes/cyan/images/smilies/icon_mrgreen.gif" alt="" /></a>
</p>
<p><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>',
'label_submit'=> '确认提交',
);
comment_form($args);
?>

<?php endif; ?>

<?php endif; ?>