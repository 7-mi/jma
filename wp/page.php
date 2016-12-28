<?php
/*
Template Name:固定ページテンプレート
*/
?>
<?php include_once('header.php'); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php remove_filter('the_content', 'wpautop'); ?>
<?php the_content(); ?>
<?php endwhile; else: ?>
<?php endif; ?>

<?php include_once('footer.php'); ?>
