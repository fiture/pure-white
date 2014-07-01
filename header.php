<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php include(TEMPLATEPATH . '/seo.php'); ?>
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ) ?>/static/css/reset.css" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ) ?>/style.css" />
    <?php if(is_single()) : ?>
        <link rel="stylesheet" href="<?php bloginfo( 'template_url' ) ?>/static/css/comment.css" />
    <?php endif; ?>
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
        <script src="<?php bloginfo('template_url'); ?>/static/js/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <hgroup class="wrapper">
            <h1 class="logo">
                <a href="<?php bloginfo('url') ?>" title="FITURE">F<b>I</b>T<b>U</b>RE</a>
            </h1>
            <p class="des">If you can fight, fight.</p>
        </hgroup>
        <?php
            //自定义菜单
            $args = array(
                'container' => 'nav',
                'container_class' => 'g-nav wrapper clearfix',
                'theme_location' => 'primary',
                'item_wrap' => '<ul>%3$s</ul>'
            );

            wp_nav_menu($args);
        ?>    
    </header>

    <div class="container">
