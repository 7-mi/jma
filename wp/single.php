<?php include_once('header.php'); ?>


	<div class="l-contents l-topics l-topics-single cf">
		<div class="wrap">
		<div class="l-main">
			 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post-box">
				<div class="post-head">
					<h1 class="ttl"><?php the_title(); ?></h1>
					<span class="date"><?php the_time('Y.m.d'); ?></span>
					<span class="cat-name"><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></span>
					<span class="tag-name">
					<?php
					$posttags = get_the_tags();
					if ($posttags):
					foreach($posttags as $tag): ?>

					<span><?php echo $tag->name; ?></span>

					<?php endforeach; endif;?>
					</span>
				</div>
				<div class="topics-post">
					<?php the_post_thumbnail('full'); ?>
					<?php the_content(); //本文?>
				</div>
			</article>
			<?php endwhile; else: ?>
			<p>まだ投稿はありません</p>
			<?php endif; ?>

			<ul class="prev-next cf">
				<li class="left-box"><?php previous_post_link('＜ %link', '%title', TRUE, ''); ?></li>
				<li class="right-box"><?php next_post_link('%link ＞', '%title', TRUE, ''); ?></li>
			</ul>

		</div>
		<?php include_once('part-side-topics.php'); ?>
		</div><!-- .wrap -->
	</div><!-- /.l-contents -->

<?php include_once('footer.php'); ?>
