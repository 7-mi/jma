
<?php
$my_query = new WP_Query(
    array(
        'post_type' => 'schedule',  //投稿タイプ指定（カスタム投稿ならその名前）
        'posts_per_page' => -1,  //出力数
        'post_status' => 'publish',
		'caller_get_posts' => 1,
		'tax_query' => array( //タクソノミー、タームの設定
			array(
				'taxonomy' => 'course',
				'field' => 'slug', //基本的にslugに指（必須）
				'terms' => 'mdc' //
			)
		)
    )
    );
if ( $my_query->have_posts() ) :?>

<?php while ($my_query->have_posts()): $my_query->the_post();?>

	<table class="one-column"><tbody>
		<tr><th colspan="2"><?php the_title(); ?></th></tr>
		<?php
		   $course_schedule = SCF::get( 'course_schedule' );
		   foreach ( $course_schedule as $field_name => $field_value ) {
		 ?>
		 <tr>
			 <td><?php echo  $field_value['year'] ; ?>年</td>
			 <td>
				 <?php echo nl2br( $field_value['schedule'] ); ?>
			 </td>
		 </tr>
		 <?php } ?>
	 </tbody></table>
<?php endwhile;?>

<?php endif; wp_reset_postdata();?>
