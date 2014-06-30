<?php get_header() ?>

<div class="main grid-990">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="post clearfix">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-content">
                <?php echo mb_strimwidth(strip_tags($post->post_content),0,268,'...<a class="readmore" href="'.get_permalink().'">[阅读全文]</a>'); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'icever' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div>
            <div class="entry-meta">
                <?php
                    //标签
                    $tag_list = get_the_tag_list('<div class="tags">','','</div>');
                    echo $tag_list;
                ?>
                <div class="comment-count">
                    <?php the_date('F j, Y');?> / <a href="<? the_permalink();?>#comment"><?php comments_number(); ?></a>
                </div>
            </div>
        </section>
    <?php endwhile;?>
    <?php endif; ?>

    <div class="g-pages clearfix">
        <?php pagenavi(); ?>
    </div>
</div>

<?php get_footer(); ?>
