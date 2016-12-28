<aside class="l-side">
	<h4 class="side-ttl side-cat-ttl">カテゴリー</h4>
	<ul class="side-list side-cat-list">
		<?php
			$cat_all = get_terms( "category", "fields=all&get=all" );
			foreach($cat_all as $value):
		 ?>
		<li><a href="<?php echo get_category_link($value->term_id); ?>" ><?php echo $value->name;?>(<?php echo get_category($value->term_id)->category_count; ?>)</a></li>
		<?php endforeach; ?>
	</ul>
	<h4 class="side-ttl side-tag-ttl">タグ</h4>
	<ul class="side-list side-tag-list">
		<?php
		$posttags = get_tags();
		if ($posttags) {
		foreach($posttags as $tag) {
		echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a> </li>';
		}
		}
		?>
	</ul>
	<h4 class="side-ttl side-ranking-ttl">ランキング</h4>
	<?php
	$args = array(
	'wpp_start' => '<ul class="side-list side-ranking-list">',
	'wpp_end' => '</ul>',
	'post_html' => '<li>{thumb}<a href="{url}"><span class="rank"></span><p class="side-rank-txt">{text_title}</p></a></li>',
	'stats_comments'=> 0,
	'limit' => 3,
	 'range' => 'weekly',
	'post_type' => 'post',
	'thumbnail_height' => 109,
	'thumbnail_width' => 240,
	 'title_length' => 15,
	);
	wpp_get_mostpopular( $args );
	?>


</aside><!-- .l-side -->
