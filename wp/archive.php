
<?php include_once('header.php'); ?>
	<div class="l-contents l-topics cf">
		<div class="wrap">
		<div class="l-main">
			<section class="topics-box cf">
				<?php if (in_category(1)) : ?>
					<h3 class="topics-head"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></h3>
				    <p class="intro-txt">
				  	   一般社団法人日本能率協会や、教育・研修に関する様々な情報を配信しています。
				    </p>
				<?php elseif (in_category(3)) : ?>
						<h3 class="topics-head"><h3 class="topics-head"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></h3></h3>
						<p class="intro-txt">
							階層別研修を利用した企業のご担当者にインタビューした内容をご紹介しております。
						</p>
					<?php elseif (in_category(4)) : ?>
						<h3 class="topics-head"><h3 class="topics-head"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></h3></h3>
						<p class="intro-txt">
							研修について
						</p>
					<?php else : ?>
						<h3 class="topics-head">コンテンツ一覧</h3>
					    <p class="intro-txt">
					  	 一般社団法人日本能率協会や、教育・研修に関する様々な情報を配信しています。
					    </p>
					<?php endif; ?>

			</section><!-- .company-box -->
			<div class="cat-area cf">
				<p class="left-box second-key-color">カテゴリー：<?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></p>
			</div>
			<ul class="topics-list">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
			<?php endwhile; else: ?>
		 <li>まだ投稿はありません</li>
			 <?php endif; ?>
			</ul>
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

		</div>
		<?php include_once('part-side-topics.php'); ?>
		</div><!-- .wrap -->
	</div><!-- /.l-contents -->

<?php include_once('footer.php'); ?>
