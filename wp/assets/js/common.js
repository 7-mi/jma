
$(function() {
	(function () {
			var _top = $(window).scrollTop();
			var _left = $(window).scrollLeft();
			$(window).scrollTop(0);
			$(window).scrollLeft(0);
			$('#header').gpFloatX();
			$(window).scrollTop(_top);
			$(window).scrollLeft(_left);
		})();

	/**
	 * ページ内スクロール
	 * #の付いたリンクを自動的にスクロール化する
	 */
	// $('a[href^="#"]').click(function(){
	// 	var speed = 500;
	// 	var href= $(this).attr("href");
	// 	var target = $(href == "#" || href === "" ? 'html' : href);
	// 	var position = target.offset().top;
	// 	$("html, body").not(':animated').animate({scrollTop:position}, speed, "swing");
	// 	return false;
	// });
	$('a[href^="#"]').click(function() {
		var speed = 500;
		var href= $(this).attr("href");
		var target = $(href == "#" || href === "" ? 'html' : href);
		var headerHeight = 100; //固定ヘッダーの高さm
		var position = target.offset().top - headerHeight; //ターゲットの座標からヘッダの高さ分引く
		$('body,html').animate({scrollTop:position}, speed, 'swing');
		return false;
	});

	//カラムの高さをそろえる
	$('.top-program-list li a').matchHeight();
	$('.course-object p').matchHeight();
	$('.course-program > li').matchHeight();
	$('.lecture-list > li').matchHeight();
	$('.lecture-list > li .prof').matchHeight();
	$('.l-reason .reason-list .list-txt').matchHeight();
	$('.course-voice-list li .coment').matchHeight();


});//ready

$(window).load(function () {
	//トップスライダー
     $('.mv-slide').slick({
          slidesToShow: 1,
          slidesToScroll: 3,
          arrows: false,
          infinite: true,
          autoplay: true,
          dots:true,
          centerMode:true,
          fade:true,
		  // 自動再生で切り替えをする時間
		  autoplaySpeed: 4000,
		  // 自動再生や左右の矢印でスライドするスピード
		  speed: 700,
     });
});//load

//読み込みとスクロール時
$(window).on('load scroll', function(){
	if ($(this).scrollTop() > 695) {
		  $('.l-header').addClass('scroll');
	} else {
		$('.l-header').removeClass('scroll');
	}
});
$('.nav-program ul').hover(function(){
	$('.nav-program').toggleClass('active');
});
