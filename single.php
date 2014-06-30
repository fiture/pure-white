<?php get_header(); ?>

<div class="main grid-990 single-page">
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="post">
            <p class="gray">
                <a href="<?php bloginfo('url'); ?>">首页</a> &gt;&gt;
                <?php
                    $categorys = get_the_category();
                    $category = $categorys[0];
                    echo(get_category_parents($category->term_id,true,'&gt;&gt;'));
                    the_title();
                ?>
            </p>

            <h2 class="entry-title">
              <?php the_title(); ?>
            </h2>

            <?php if ( 'post' == get_post_type() ) : ?>
                <p class="meta">
                    Posted by <a href="<?php the_author_url(); ?>"><?php the_author(); ?></a> 
                    / <?php the_date('Y年m月d日'); ?> / 

                    <?php
                        /* translators: used between list items, there is a space after the comma */
                        $categories_list = get_the_category_list(__(' ', 'icever'));
                        if ( $categories_list ):
                    ?>
                        <span class="cat-links">
                            <?php printf( __('「'.$categories_list.'」')); ?>
                        </span>
                    <?php endif; // End if categories ?>

                    <?php edit_post_link( __( '编辑', 'icever' ), '<span class="edit-link">', '</span>' ); ?>
                </p>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'icever' ) . '</span>', 'after' => '</div>' ) ); ?>
            </div>

            <div class="entry-meta">
                <span class="tags">
                  <?php echo get_the_tag_list(); ?>
                </span>
                <a href="#" class="comment-count"><?php comments_number(); ?></a>
            </div>
        </article>

        <div class="navi">
            <ul>
                <?php previous_post_link('<li><b>上一篇：</b>%link</li>') ?>
                <?php next_post_link('<li><b>下一篇：</b>%link</li>') ?>
            </ul>
        </div>

        <?php comments_template( '', true ); ?>
    <?php endwhile; ?>
</div>

<?php //get_sidebar();?>
<?php get_footer(); ?>
