<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments-list.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要直接加载该页面，谢谢！');
    if ( post_password_required() ) { ?>

        <p class="nocomments"><?php _e('这篇文章需要密码，请输入密码访问'); ?></p> 

    <?php
        return;
    }
?>

<?php
header("Content-type: text/html;charset=UTF-8");
header('HTTP/1.1 200 OK');
global $cpage;
$comments = get_comments(array(
    'post_id' => $_POST['post_id'],
    'status' => 'approve'
));
$cpage = $_POST['page_number'];
?>
<ol class="commentlist">
    <?php wp_list_comments('type=comment&callback=mytheme_comment&max_depth=1000',$comments); ?>
</ol>

<div class="pagenavi"><?php paginate_comments_links('prev_text=上一页&next_text=下一页');?></div>