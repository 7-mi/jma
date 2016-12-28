<?php


//外部ファイルを読み込む
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');


//画像のルートパス専用
add_shortcode( 'tp', 'shortcode_tp' );
function shortcode_tp( $atts, $content = '' ) {
	return get_template_directory_uri().$content;
}


//ルートのパスを取得する
function shortcode_url() {
 return get_bloginfo('url');
}
add_shortcode('url', 'shortcode_url');

//post snippets用
add_filter('widget_text', 'do_shortcode');



/***********************************************************
* 自動絵文字機能無効化
***********************************************************/
function disable_emoji() {
     remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
     remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
     remove_action( 'wp_print_styles', 'print_emoji_styles' );
     remove_action( 'admin_print_styles', 'print_emoji_styles' );
     remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
     remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
     remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );


/*━━━━━━━━━━━━━━━
カスタム投稿
━━━━━━━━━━━━━━━*/
//$add_custompost[0] = new add_custompost('postname','表示名',array(array('tax','分類')),エディタ,アイキャッチ,アーカイブ);
$add_custompost[0] = new add_custompost('schedule','開催スケジュール',array(array('course','コース')),FALSE,FALSE,FALSE);
//$add_custompost[0] = new add_custompost('scene','写真で見る',array(array('genre','シーン')),FALSE,FALSE,FALSE);
class add_custompost{
	public $post;
	public $postname;
	public $editor;
	public $thumbnail;
	public $supports;
	public $tax;
	public function __construct($post,$postname,$tax=FALSE,$editor=FALSE,$thumbnail=FALSE,$archive=TRUE){
		$this->post = $post;
		$this->postname = $postname;
		$this->editor = $editor;
		$this->thumbnail = $thumbnail;
		$this->tax = $tax;
		$this->archive = $archive;

		$this->supports = array('title','page-attributes');
		if($this->editor){
			$this->supports[] = 'editor';
		}
		if($this->thumbnail){
			$this->supports[] = 'thumbnail';
		}
		add_action('init',array($this,'create_custompost'));
	}
	public function create_custompost(){
		$labels = array(
			'name' => _x($this->postname,'post type general name'),
			'singular_name' => _x($this->postname,'post type singular name'),
			'add_new' => _x($this->postname . 'を書く',$this->post),
			'add_new_item' => __($this->postname . 'を書く'),
			'edit_item' => __($this->postname . 'を編集'),
			'new_item' => __($this->postname),
			'view_item' => __($this->postname . 'を見る'),
			'search_items' => __($this->postname . 'を探す'),
			'not_found' => __($this->postname . 'はありません'),
			'not_found_in_trash' => __($this->postname . 'はありません'),
			'parent_item_colon' => "",
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 3,
			'supports' => $this->supports,
			'has_archive' => $this->archive,
		);
		register_post_type($this->post,$args);
		if($this->tax){
			foreach((array)$this->tax as $tax){
				register_taxonomy(
					$tax[0],
					$this->post,
					array(
						'hierarchical' => true,
						'update_count_callback' => '_update_post_term_count',
						'label' => $tax[1],
						'singular_label' => $tax[1],
						'public' => true,
						'show_ui' => true,
					)
				);
			}
		}
	}
}
/***********************************************************
* 独自画像サイズ
***********************************************************/
add_theme_support('post-thumbnails');/* アイキャッチ画像 */
add_image_size( 'topics-thumb', 440, 200, array('center','center') );
add_image_size( 'topics-rank-thumb', 240, 109, array('center','center') );
// add_image_size( 'voice-main', 2000, 800, array('center','center') );
// add_image_size( 'voice-second', 1400, 500, array('center','center') );
// add_image_size( 'voice-main-sp', 640, 620, array('center','center') );
// add_image_size( 'voice-secondsp', 640, 500, array('center','center') );
// add_image_size( 'scene-main', 1000, 650, array('center','center') );
// add_image_size( 'scene-main-sp', 600, 450, array('center','center') );
// add_image_size( 'scene-thumb', 330, 220, array('center','center') );

/***********************************************************
* 管理画面　（メニュー並び替え）
***********************************************************/
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;

	return array(
		//'separator-last', // 最後の区切り線
		'index.php', // ダッシュボード
		//カスタム投稿
		'separator1',// 最初の区切り線'separator1',
		'edit.php', // 投稿
		'edit.php?post_type=schedule',//カスタム投稿
		'separator2',// 二つ目の区切り線'separator2',
		'upload.php', // メディア
		'link-manager.php', // リンク
		'edit.php?post_type=page', // 固定ページ
		'edit-comments.php', // コメント
		'themes.php', // 外観
		'plugins.php', // プラグイン
		'users.php', // ユーザー
		'tools.php', // ツール
		'options-general.php', // 設定
	);
}
add_filter('custom_menu_order', 'custom_menu_order');
 // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

/***********************************************************
* 投稿タイトルのプレイスホルダー変更
***********************************************************/
function change_default_title( $title ) {
	$screen = get_current_screen();
	if ( $screen -> post_type == 'schedule' ) {
		$title = '会場名をいれてください';
	}
	return $title;
}
add_filter('enter_title_here', 'change_default_title');

/***********************************************************
* 固定ページのビュルアルエディタ非表示
***********************************************************/
function disable_visual_editor_in_page(){
	global $typenow;
	if( $typenow == 'page' ){
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
}
function disable_visual_editor_filter(){
	return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );
/***********************************************************
* ページ数の取得
***********************************************************/
//現在のページ数の取得
function show_page_number() {
    global $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $max_page = $wp_query->max_num_pages;
    echo $paged;
}
// /***********************************************************
// * 投稿一覧にタクソノミーを表示
// ***********************************************************/
function add_custom_column( $defaults ) {
$defaults['course'] = '表示コース';
return $defaults;
}
add_filter('manage_schedule_posts_columns', 'add_custom_column');
//add_filter('manage_posts_columns', 'add_custom_column');//通常投稿
function add_custom_column_id($column_name, $id) {
if( $column_name == 'course' ) {
echo get_the_term_list($id, 'course', '', ', ');
}
}
add_action('manage_schedule_posts_custom_column', 'add_custom_column_id', 10, 2);
