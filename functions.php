<?php
    // 添加自定义菜单 
    if (function_exists('register_nav_menus')){
        register_nav_menu('primary', __('Primary Menu'));
    }

    //分页
    //
    function pagenavi( $p = 2 ) {
        if ( is_singular() ) return;

        global $wp_query, $paged;
        $max_page = $wp_query->max_num_pages;
        $dot_text = '<span class="ellipsis">...</span>';

        if ( $max_page == 1 )
            return;
        if ( empty( $paged ) )
            $paged = 1;

        if ( $paged > 1 )
            p_link( $paged - 1, '上一页', '&laquo;' );
        if ( $paged > $p + 1 )
            p_link( 1, '最前页' );
        if ( $paged > $p + 2 )
            echo $dot_text;
        for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
            if ( $i > 0 && $i <= $max_page )
                $i == $paged ? print "<span class='cur'>{$i}</span> " : p_link( $i );
        }
        if ( $paged < $max_page - $p - 1 )
            echo $dot_text;
        if ( $paged < $max_page - $p )
            p_link( $max_page, '最末页' );
        if ( $paged < $max_page )
            p_link( $paged + 1,'下一页', '&raquo;' );

    }

    function p_link( $i, $title = '', $linktype = '' ) {
        if ( $title == '' )
            $title = "第 {$i} 页";
        if ( $linktype == '' ) {
            $linktext = $i;
        } else {
            $linktext = $linktype;
        }
        echo "<a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
    }
    //分页END
    

    //评论回复邮件通知
    function comment_mail_notify($comment_id) {
      $comment = get_comment($comment_id);
      $comment_author_email = trim($comment->comment_author_email);
      $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
      $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';
      $spam_confirmed = $comment->comment_approved;
      if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email) &&($comment_author_email != $to)) {
              
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回应';
        $message = '
            <div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px"><p><strong>@' . trim(get_comment($parent_id)->comment_author) . '</strong> 童鞋，您在 <strong>《' . get_the_title($comment->comment_post_ID) . '》</strong> 上的评论被围观了！</p></div><div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px"><p><strong>您</strong> 说:'. nl2br(get_comment($parent_id)->comment_content) . ' </p><p><strong>' . trim($comment->comment_author) . '</strong> 回:'. nl2br($comment->comment_content) . '</p><p><small><em>反围观，请猛击： <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank">查看详情</a></em></small></p></div><p style="float:right"><strong> —— 来自： <a href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a></strong></p>
            ';
            
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
      }
    }

    add_action('comment_post', 'comment_mail_notify');
    // -- END ----------------------------------------
?>
