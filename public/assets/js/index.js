/* global $ */
/* global jQuery */
/* global InfiniteScroll */
/* global location */
/* global Swiper */

// ------------------
// 文字数カウント
// ------------------
$(function(){
  $('#who').keyup(function(){
    let count = $(this).val().length;
    $('.name-count').text(count);
  });
});

$(function(){
  $('#title').keyup(function(){
    let count = $(this).val().length;
    $('.show-count').text(count);
  });
});



// ------------------
// 固定表示
// ------------------
let navPos = jQuery( '#select' ).offset().top; // グローバルメニューの位置
let navHeight = jQuery( '#select' ).outerHeight(); // グローバルメニューの高さ
jQuery( window ).on( 'scroll', function() {
  if ( jQuery( this ).scrollTop() > navPos ) {
    jQuery( 'body' ).css( 'padding-top', navHeight );
    jQuery( '#select' ).addClass( 'm_fixed' );
  } else {
    jQuery( 'body' ).css( 'padding-top', 0 );
    jQuery( '#select' ).removeClass( 'm_fixed' );
  }
});


let navPos2 = jQuery( '#tab' ).offset().top; // グローバルメニューの位置
let navHeight2 = jQuery( '#tab' ).outerHeight(); // グローバルメニューの高さ
jQuery( window ).on( 'scroll', function() {
  if ( jQuery( this ).scrollTop() > navPos2 ) {
    jQuery( 'body' ).css( 'padding-top', navHeight2 );
    jQuery( '#tab' ).addClass( 'fixed' );
  } else {
    jQuery( 'body' ).css( 'padding-top', 0 );
    jQuery( '#tab' ).removeClass( 'fixed' );
  }
});



// ------------------
// クリックで商品画像追加
// ------------------
$(window).on('load',function(){
  let default_src =$('.default').attr('src');
  $(document).on('click', '.item', function(){ 
    let img = $('.img',this).attr('src');
    let url = $('.url',this).attr('href');
    let price = $('.price',this).data('id');
    let cate = $('.cateEn',this).data('id');
    let item1 = $('#item1').attr('src');
    let item2 = $('#item2').attr('src');
    let item3 = $('#item3').attr('src');
    let item4 = $('#item4').attr('src');
    let item5 = $('#item5').attr('src');
    if(item1 ===default_src){
      $('#item1').attr('src', img);
      $('#img1').attr('value', img);
      $('#url1').attr('value', url);
      $('#price1').attr('value', price);
      $('#genre1').attr('value', cate);
      if(item4 !==default_src&&item3 !==default_src&&item2 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item2 ===default_src){
      $('#item2').attr('src', img);
      $('#img2').attr('value', img);
      $('#url2').attr('value', url);
      $('#price2').attr('value', price);
      $('#genre2').attr('value', cate);
      if(item4 !==default_src&&item3 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item3 ===default_src){
      $('#item3').attr('src', img);
      $('#img3').attr('value', img);
      $('#url3').attr('value', url);
      $('#price3').attr('value', price);
      $('#genre3').attr('value', cate);
      if(item4 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item4 === default_src){
      $('#item4').attr('src', img);
      $('#img4').attr('value', img);
      $('#url4').attr('value', url);
      $('#price4').attr('value', price);
      $('#genre4').attr('value', cate);
      // if(item5 !==default_src){
        $('#submit').attr('type', "submit");
      // }
    }else if(item5 ===default_src){
      $('#item5').attr('src', img);
      $('#img5').attr('value', img);
      $('#url5').attr('value', url);
      $('#price5').attr('value', price);
      $('#genre5').attr('value', cate);
      $('#submit').attr('type', "submit");
    }else{
      $('#submit').attr('type', "submit");
    }
  $('#item1').on('click', function (){
      $(this).attr('src',default_src);
      $('#img1').attr('value', default_src);
      $('#url1').attr('value', "");
      $('#price1').attr('value', "");
      $('#genre1').attr('value', "");
      $('#submit').attr('type', "hidden");
    })
    $('#item2').on('click', function(){
      $(this).attr('src',default_src);
      $('#img2').attr('value', default_src);
      $('#url2').attr('value', "");
      $('#price2').attr('value', "");
      $('#genre2').attr('value', "");
      $('#submit').attr('type', "hidden");
    })
    $('#item3').on('click', function(){
      $(this).attr('src',default_src);
      $('#img3').attr('value', default_src);
      $('#url3').attr('value', "");
      $('#price3').attr('value', "");
      $('#genre3').attr('value', "");
      $('#submit').attr('type', "hidden");
    })
    $('#item4').on('click', function(){
      $(this).attr('src',default_src);
      $('#img4').attr('value', default_src);
      $('#url4').attr('value', "");
      $('#price4').attr('value', "");
      $('#genre4').attr('value', "");
      $('#submit').attr('type', "hidden");
    })
    $('#item5').on('click', function(){
      $(this).attr('src',default_src);
      $('#img5').attr('value', default_src);
      $('#url5').attr('value', "");
      $('#price5').attr('value', "");
      $('#genre5').attr('value', "");
      // $('#submit').attr('type', "hidden");
    })
    
   
 
  });


});

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

  // タップした時にスライドに合わせてメニューに動きをつける
  galleryThumbs.on('tap', function () {
   var current = galleryTop.activeIndex;
   galleryThumbs.slideTo(current, 500, true);
  });
  
  var galleryTop = new Swiper('.tab-contents', {
    // autoHeight: true,
    autoHeight: false,
    thumbs: {
      swiper: galleryThumbs
    }
  });
  

// ------------------
// ページネーションした時にタブスワイプをごにょごにょ
// https://www.tam-tam.co.jp/tipsnote/javascript/post9911.html
// https://hajimete.org/jquery-subsequent-string-deletion
// ------------------
// URLのパラメータを取得
let urlParam = location.search.substring(1);
let cut = "=";
let paramArrey = urlParam.split(cut);
let paramName = paramArrey[0];
console.log(paramName);

$(window).on('load',function(){
  if (paramName == 'tops') {

  } else if(paramName == 'bottoms') {

  } else if(paramName == 'onepiece') {
 
  } else if(paramName == 'allinone') {
  } else if(paramName == 'outer') {
  } else if(paramName == 'shoes') {
  } else if(paramName == 'bag') {
  } else if(paramName == 'accessory') {
  } else if(paramName == 'jewelry') {
  }

});


// ------------------
// やり直し
// https://www.atmarkit.co.jp/ait/articles/1607/13/news032.html
// ------------------

// function getParams() {
//   "use strict";

//   // URLから「?」以降の文字列を取り出す
//   var query = location.search.substr(1);

//   // 「&」で分割して、順に処理する
//   var params = {};
//   query.split("&").forEach(function (item) {
//     // 「=」でパラメーター名と値に分割して、paramsに追加
//     var s = item.split("=");
//     var k = decodeURIComponent(s[0]);
//     var v = decodeURIComponent(s[1]);
//     (k in params) ? params[k].push(v) : params[k] = [v];
//   });

//   return params;
// }


// ------------------
// https://www.tam-tam.co.jp/tipsnote/javascript/post9911.html
// https://hajimete.org/jquery-subsequent-string-deletion
// ------------------
// URLのパラメータを取得
// let urlParam = location.search.substring(1);
// let cut = "=";
// let paramArrey = urlParam.split(cut);
// let paramName = paramArrey[0];
// console.log(paramName);

  // パラメータidによって飛び先を変える
// $(".page-link").on("click",function(){
//     $("#tops,#bottoms,#onepiece,#allinone,#outer,#shoes,#bag,#accessory,#jewelry").toggleClass("swiper-slide-thumb-active");
//     $(".swiper-slide").toggleClass("swiper-slide-active");
// }
  
  // if (paramName == 'tops') {
  //   $("#tops").toggleClass("swiper-slide-thumb-active");
  //   $("#bottoms").toggleClass("swiper-slide-thumb-active");
  //   $("#onepiece").toggleClass("swiper-slide-thumb-active");
  //   $("#allinone").toggleClass("swiper-slide-thumb-active");
  //   $("#outer").toggleClass("swiper-slide-thumb-active");
  //   $("#shoes").toggleClass("swiper-slide-thumb-active");
  //   $("#bag").toggleClass("swiper-slide-thumb-active");
  //   $("#accessory").toggleClass("swiper-slide-thumb-active");
  //   $("#jewelry").toggleClass("swiper-slide-thumb-active");
  //   console.log("OK");
  // } else if(paramName == 'bottoms') {
  //   $("#tops").toggleClass("swiper-slide-thumb-active");
  //   $("#bottoms").toggleClass("swiper-slide-thumb-active");
  //   $("#onepiece").toggleClass("swiper-slide-thumb-active");
  //   $("#allinone").toggleClass("swiper-slide-thumb-active");
  //   $("#outer").toggleClass("swiper-slide-thumb-active");
  //   $("#shoes").toggleClass("swiper-slide-thumb-active");
  //   $("#bag").toggleClass("swiper-slide-thumb-active");
  //   $("#accessory").toggleClass("swiper-slide-thumb-active");
  //   $("#jewelry").toggleClass("swiper-slide-thumb-active");
  // } else if(paramName == 'onepiece') {
  //   $("#tops").toggleClass("swiper-slide-thumb-active");
  //   $("#bottoms").toggleClass("swiper-slide-thumb-active");
  //   $("#onepiece").toggleClass("swiper-slide-thumb-active");
  //   $("#allinone").toggleClass("swiper-slide-thumb-active");
  //   $("#outer").toggleClass("swiper-slide-thumb-active");
  //   $("#shoes").toggleClass("swiper-slide-thumb-active");
  //   $("#bag").toggleClass("swiper-slide-thumb-active");
  //   $("#accessory").toggleClass("swiper-slide-thumb-active");
  //   $("#jewelry").toggleClass("swiper-slide-thumb-active");
  // } else if(paramName == 'allinone') {
  // } else if(paramName == 'outer') {
  // } else if(paramName == 'shoes') {
  // } else if(paramName == 'bag') {
  // } else if(paramName == 'accessory') {
  // } else if(paramName == 'jewelry') {
  // }
// });




// $(".page-link").on("click",function(){
//     const key = $("#date").val();
//     const val = $("#title").val();
//     const value2 = $("#cate").val();  
// });


// ------------------
//class="page-link"を押下すると、aタグ内のhref内の?～=の間の文字列を取得して、
// その文字列と同じIDのdiv内のclassに swiper-slide-thumb-active を付与 idが一致しない場合はクラス消す
// https://www.tam-tam.co.jp/tipsnote/javascript/post9911.html
// https://hajimete.org/jquery-subsequent-string-deletion
// https://oshiete.goo.ne.jp/qa/9046629.html
// <a class="page-link" href="https://9734529812ac45d59038b742d16c90c7.vfs.cloud9.us-east-1.amazonaws.com/post?tops=2" rel="next">Next »</a>
// ------------------

// let page_href =$('.page-link').attr('href');
// let cut = "=";
// let pos = txt.split(cut);
// let under_cut= $(page_href).text(pos[0]+cut);
// console.log(under_cut);




// $('.page-link').on('click', function(){
//     console.log("クリック");
// });  
  
  
//   let url=$('.page-link').attr('href');

// if(url.indexOf("?")>=0){
// let str1=url.substring(url.indexOf("?")+1,url.length);
// }
// document.write(str1+"<br>");
// console.log(str1);

// let reg=new RegExp("\\?(.+?)$");
// if(url.match(reg)){
// let str2=url.match(reg)[1];
// }
// document.write(str2);
// console.log(str2);
// });
// $('.page-link').on('click', function(){
//   $('#genre5').attr('value', "");

// });







// ------------------
// 無限スクロール
// https://mrkmyki.com/laravel%E3%81%AEpaginate%E3%81%A8infinite-scroll%E3%82%92%E4%BD%BF%E3%81%84%E3%80%81%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9%E5%86%85%E3%81%AE%E3%83%87%E3%83%BC%E3%82%BF%E3%82%92
// https://on-ze.com/archives/2486
// https://github.com/metafizzy/infinite-scroll
// ------------------
let scrollId = $('.cssgrid',this).data('infinite-scroll');


