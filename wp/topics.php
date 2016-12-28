<?php
/*
Template Name:JMAに関する最新情報を配信topics
*/
?>
<?php include_once('header.php'); ?>
	<div class="l-contents l-topics cf">
		<div class="wrap">
		<div class="l-main">
			<section class="topics-box cf">
				<h3 class="topics-head">コンテンツ一覧</h3>
				<p class="intro-txt">
					一般社団法人日本能率協会や、教育・研修に関する様々な情報を配信しています。
				</p>
			</section><!-- .company-box -->
			<div class="cat-area cf">
				<p class="left-box second-key-color">カテゴリー：全件</p>
				<?php
					$count = wp_count_posts( 'post' );//投稿数を取得
					$published_count = $count->publish;//その中で公開中のもののみカウント
					$page_no = $published_count / 10 + 1;
					$surplus = $published_count % 10;
					if ($published_count <= 10){//全投稿数が10以下の場合
						$item = $published_count;
					}else{//その他
						$item = 10;
					}
				?>
				<p class="right-box">(<?php echo $item ?>件表示中/全<?php echo $published_count ?>件中)</p>
			</div>
			<?/*php show_page_number(''); */?>
			<ul class="topics-list">
				<?php
						$paged = get_query_var('paged'); //ページ番号を取得
						$my_query = new WP_Query(
						    array(
						        'post_type' => 'post',  //投稿タイプ指定（カスタム投稿ならその名前）
						        'posts_per_page' => 10,  //出力数
						        'post_status' => 'publish', //
								        'caller_get_posts' => 1,
						        'orderby'=>'date',   //投稿日順
						        'order'=>'DESC',   //降順
								        'paged'=>$paged    //ページ番号を考慮
						    )
						    );
						if ( $my_query->have_posts() ) : while ($my_query->have_posts()): $my_query->the_post();
						?>
				<li>
					<a href="<?php the_permalink(); ?>" class="cf">
						<div class="left-box img-box">
							<?php
								// アイキャッチ画像の確認
								if ( has_post_thumbnail()) {
								    // 存在する
								    the_post_thumbnail('topics-thumb');
								}
								else {
								    // 存在しない
								    echo '<img src="'.get_template_directory_uri().'/assets/img/page/topics/topics_noimage.png" width="440" height="220">';
								}
							 ?>
						</div><!-- .left-box -->
						<div class="right-box txt-box">
							<span class="date"><?php the_time('Y/m/d'); ?></span>
							<span class="cat-name"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span>
							<h4 class="ttl"><?php the_title(); ?></h4>
						</div><!-- .right-box -->
					</a>
				</li>
				<?php endwhile; endif; wp_reset_postdata();?>
			</ul>
			<?php if(function_exists('wp_pagenavi')) wp_pagenavi(array('query' => $my_query)); ?>

		</div>
		<?php include_once('part-side-topics.php'); ?>
		</div><!-- .wrap -->
	</div><!-- /.l-contents -->

<?php include_once('footer.php'); ?>
