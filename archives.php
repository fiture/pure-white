<?php get_header(); ?>

<div class="main wrapper">
    <article class="archives">
        <ul class="archive-content clearfix">
            <li>
                <h3>存档：</h3>
                <ul>
                    <?php wp_get_archives('show_post_count=1'); ?>
                </ul>
            </li>
            <li>
                <h3>标签：</h3>
                <?php
                    $tags = get_tags(
                        array(
                            orderby => 'count',
                            order=> 'DESC',
                            number => 38
                        )
                    );

                    $html = '<ul>';
                    foreach ( $tags as $tag ) {
                        $tag_link = get_tag_link( $tag->term_id );        
                        $html .= "<li><a href='{$tag_link}'>{$tag->name}</a> ({$tag->count})</li>";
                    }
                    $html .= '</ul>';
                    echo $html;
                ?>
            </li>
            <?php
                wp_list_categories(array(
                    title_li => '<h3>分类：</h3>'
                ));

            ?>
            
        </ul>
    </article>
</div>

<?php //get_sidebar();?>
<?php get_footer(); ?>
