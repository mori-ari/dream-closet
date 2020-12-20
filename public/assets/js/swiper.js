/* global Swiper */
// ------------------
// タブスワイプ
// ------------------
//初期化
var galleryThumbs = new Swiper('.tab-menu', {
    spaceBetween: 20,
    slidesPerView: 'auto',
    freeMode: false,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    slideActiveClass: 'swiper-slide-active'
  });

  // リフレッシュを呼び出せないか　
  
  // タップした時にスライドに合わせてメニューに動きをつける
  galleryThumbs.on('tap', function () {
   var current = galleryTop.activeIndex;
   galleryThumbs.slideTo(current, 500, true);
  });
  
  var galleryTop = new Swiper('.tab-contents', {
    autoHeight: true,
    thumbs: {
      swiper: galleryThumbs
    }
  });