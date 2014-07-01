<?php get_header(); ?>

<div class="main wrapper single-page">
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="post">
            <h2 class="entry-title">
              <?php the_title(); ?>
            </h2>
            <div class="entry-content">
                <?php
                    /*
                    if(is_page('friends')) {
                        wp_list_bookmarks(array(
                            orderby => 'rand',
                            title_before => '<h3>',
                            title_after => '</h3>',
                            category_before => '<div id="friends" class="clearfix">',
                            category_after => '</div>'
                        ));
                    }
                    */
                ?>
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'icever' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php //get_sidebar();?>
<?php get_footer(); ?>
