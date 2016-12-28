<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<?php if (!is_home() && !is_front_page()): ?>
	<?php global $aioseop_options ?>
	 <?php if (!get_post_meta($post->ID, _aioseop_description, true)): ?>
	 <meta name="description" itemprop="description" content="<?php echo $aioseop_options['aiosp_home_description']; ?>">
	 <?php endif; ?>
	 <?php if (!get_post_meta($post->ID, _aioseop_keywords, true)): ?>
	 <meta name="keywords" itemprop="keywords" content="<?php echo $aioseop_options['aiosp_home_keywords']; ?>">
	 <?php endif; ?>
	<?php endif; ?>
	<title></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css" />
	<?php if ( is_home() || is_front_page() ) : ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/top.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/slick.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/slick-theme.css" />
	<?php else : ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/page.css" />
	<?php endif; ?>
	<link rel="shortcut icon" href="<?php echo home_url('/'); ?>/assets/img/favicon.ico">
	<!-- ▼Google Analyticsトラッキングコード▼ -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-89435874-1', 'auto');
		ga('send', 'pageview');

	</script>
	<!-- ▲Google Analyticsトラッキングコード▲ -->
	<?php wp_head(); ?>
</head>
<body>
	<div class="h1-area">
	<?php if(get_post_meta($post->ID,'h1',TRUE)) : ?>
		<h1><?php echo get_post_meta($post->ID,"h1",true); ?></h1>
	<?php else : ?>
		<h1><?php wp_title(''); ?></h1>
	<?php endif; ?>
	</div><!-- .h1area -->
	<header class="l-header cf" id="header">
		<h2 class="header-logo">
			<a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/layout/header/header_logo.png" width="260" height="35" alt="JMA階層別研修プログラム"></a>
		</h2>

		<nav class="l-nav">
			<ul class="nav-list cf">
				<li><a href="<?php echo home_url('/concept/'); ?>">選ばれる理由</a></li>
				<li><a href="<?php echo home_url('/program-list/'); ?>">プログラム一覧</a></li>
				<li><a href="<?php echo home_url('/lecturer/'); ?>">講師紹介</a></li>
				<li><a href="<?php echo home_url('/category/voice/'); ?>">企業担当者の声</a></li>
				<li><a href="<?php echo home_url('/faq/'); ?>">FAQ</a></li>
				<li class="nav-btn-01 nav-btn"><a href="http://event.jma-communication.com/k_inquiry" target="_blank">お問合せ</a></li>
				<li class="nav-btn-02 nav-btn"><a href="http://event.jma-communication.com/k_inquiry" target="_blank">資料請求</a></li>
			</ul>
		</nav><!-- /.l-navi -->
	</header><!-- /.l-header -->
<?php if ( !is_front_page() && !is_home() ) :?>
	<?php
	if ( is_page('program-list') ) :
		$slug = program ;
	elseif(	is_single() || is_post_type_archive() || is_category()|| is_tag()  ):
		$slug = topics ;
	elseif(	is_page('concept') ):
		$slug = reason ;
	elseif(	is_page('gmc') ||	is_page('mdc') ||	is_page('ldc') ||	is_page('btc') ||	is_page('bhc') ):
		$slug = course ;
		if ( is_page('gmc') ) :
			$mv = 'course-01';
		elseif( is_page('mdc') ) :
			$mv = 'course-02';
		elseif( is_page('ldc') ) :
			$mv = 'course-03';
		elseif( is_page('btc') ) :
			$mv = 'course-04';
		elseif( is_page('bhc') ) :
			$mv = 'course-05';
		endif;
	else:
		$slug =  $post->post_name;
	endif;
	 ?>
	<?php if( is_page('gmc') ||	is_page('mdc') ||	is_page('ldc') ||	is_page('btc') ||	is_page('bhc')  ):?>
	<div class="l-pagemv <?php echo $mv ?>-mv">
	<?php else: ?>
	<div class="l-pagemv <?php echo $slug ?>-mv">
	<?php endif; ?>
		<div class="page-head">
			<h2 class="fjalla center"><?php echo $slug ?></h2>
			<?php if( is_single()|| is_post_type_archive() || is_category()|| is_tag()) : ?>
			<p class="ja-ttl center">JMAに関する最新情報を配信</p>
			<?php else: ?>
			<p class="ja-ttl center"><?php the_title_attribute(); ?></p>
			<?php endif; ?>
		</div>
	</div><!-- .l-pagemv -->
	<div class="l-breadcrumbs cf">
		<ul class="wrap">
			<li><a href="<?php echo home_url('/'); ?>">TOP</a></li>
			<?php if( is_single()|| is_category()|| is_tag()) : ?>
			<li><a href="<?php echo home_url('/topics/'); ?>">JMAに関する最新情報を配信</a></li>
			<?php endif; ?>
			<?php if( is_post_type_archive() ) : ?>
			<li>JMAに関する最新情報を配信</li>
			<?php elseif( is_category() ) : ?>
			<li><?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?></li>
			<?php elseif( is_tag() ) : ?>
			<li><?php $tag = get_queried_object(); echo $tag->name ?></li>
			<?php else: ?>
			<li><?php the_title_attribute(); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .l-breadcrumbs -->
<?php endif; ?>
