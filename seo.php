<?php
if (!function_exists('utf8Substr')) {
	function utf8Substr($str, $from, $len)
	{
     	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          	'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          	'$1',$str);
	}
}
elseif (is_single()) {
    if ($post->post_excerpt)
	{
        $description  = $post->post_excerpt;
    }
	else
	{
		if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result))
		{
			$post_content = $result['1'];
		}
		else
		{
			$post_content_r = explode("\n",trim(strip_tags($post->post_content)));
			$post_content = $post_content_r['0'];
		}
		$description = utf8Substr($post_content,0,220);  
	}
    $keywords = "";     
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag )
	{
		$keywords = $keywords . $tag->name . ",";
	}
}
?>
<?php if($description != '') : ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<?php endif; ?>
<?php if($keywords != '') : ?>
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php endif; ?>
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?>
</title>
