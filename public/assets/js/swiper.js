/* global Swiper */
// // ------------------
// // タブスワイプ
// // ------------------
// //初期化
// var galleryThumbs = new Swiper('.tab-menu', {
//     spaceBetween: 20,
//     slidesPerView: 'auto',
//     freeMode: false,
//     watchSlidesVisibility: true,
//     watchSlidesProgress: true,
//     slideActiveClass: 'swiper-slide-active'
//   });

//   // タップした時にスライドに合わせてメニューに動きをつける
//   galleryThumbs.on('tap', function () {
//   var current = galleryTop.activeIndex;
//   galleryThumbs.slideTo(current, 500, true);
//   });
  
//   var galleryTop = new Swiper('.tab-contents', {
//     autoHeight: true,
//     // autoHeight: false,
//     thumbs: {
//       swiper: galleryThumbs
//     }
//   });
  
  
  
// $(".page-link").on("click",function(){
//     var galleryThumbs = new Swiper('.tab-menu', {
//     spaceBetween: 20,
//     slidesPerView: 'auto',
//     freeMode: false,
//     watchSlidesVisibility: true,
//     watchSlidesProgress: true,
//     slideActiveClass: 'swiper-slide-active'
//   });

//   // タップした時にスライドに合わせてメニューに動きをつける
//   galleryThumbs.on('tap', function () {
//   var current = galleryTop.activeIndex;
//   galleryThumbs.slideTo(current, 500, true);
//   });
  
//   var galleryTop = new Swiper('.tab-contents', {
//     autoHeight: true,
//     // autoHeight: false,
//     thumbs: {
//       swiper: galleryThumbs
//     }
//   });
    
// });
  
//   var tab = new Swiper('.tab-content', {
//     slidesPerView: 1,
//     autoHeight: true,
    
//     thumbs: {
//         swiper: {
//             el: '.tab-menu',
//             slidesPerView: 4,
//         }
//     },
// });