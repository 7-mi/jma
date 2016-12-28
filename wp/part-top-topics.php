<ul class="top-news-list">
<?php
$my_query = new WP_Query(
    array(
        'post_type' => 'post',  //投稿タイプ指定（カスタム投稿ならその名前）
        'posts_per_page' => 3,  //出力数
        'post_status' => 'publish', //
		'caller_get_posts' => 1,
        'orderby'=>'date',   //投稿日順
        'order'=>'DESC',   //降順
    )
    );
if ( $my_query->have_posts() ) : while ($my_query->have_posts()): $my_query->the_post();
?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php
				$cat = get_the_category();
				$cat_name = $cat[0]->cat_name; // カテゴリー名
				$cat_slug  = $cat[0]->category_nicename; // カテゴリースラッグ
			?>
			<span class="cat cat-<?php echo $cat_slug ?>"><?php echo $cat_name ?></span>
			<span class="date"><?php the_time('Y.m.d'); ?></span>
			<span class="ttl">
			<?php
			if(mb_strlen(get_the_title(), 'UTF-8')>60){//60文字超えたら省略+末尾に…
				$title= mb_substr(get_the_title(), 0, 60, 'UTF-8');
				echo $title.'…';
			}else{
				echo get_the_title('');
			}
			?>
			</span>
		</a>
	</li>
<?php endwhile; endif; wp_reset_postdata();?>
</ul>
