/* global $ */
/* global location */
/* global Swiper */
/* global localStorage */
/* global item1 */
/* global item2 */
/* global item3 */
/* global item4 */
/* global item5 */





// ┳┻| 
// ┻┳| 
// ┳┻|_∧ 
// ┻┳|ω･)  ｺｰﾄﾞ見ﾗﾚﾃﾏｽｶ…??
// ┳┻|⊂ﾉ 
// ┻┳| Ｊ
// ループさせずにダダ並びのアナログjs書いててすみません。
// 恥ずかしい。





// ------------------
// ローディング　https://ponsyon.com/archives/3707
// ------------------
$(window).on('load',function(){
   $("#loading-wrapper").addClass("completed")
});
// setTimeout(function() {
//     $('#loading-wrapper').fadeOut(500);
// }, 6000); // 6秒後にfadeOut処理


// ------------------
// 結果ページ 価格カンマ（フォント的にアンマッチなのでやめた）
// ------------------
// function strIns(str, idx, val){
//   let res = str.slice(0, idx) + val + str.slice(idx);
//   return res;
// };

//   let num1 = $('#price_1').data('id');
//   let num2 = $('#price_2').data('id');
//   let num3 = $('#price_3').data('id');
//   let num4 = $('#price_4').data('id');
//   let num5 = $('#price_5').data('id');
//     console.log(num1);
//   let commma1 = num1.toLocaleString();
//   let commma2 = num2.toLocaleString();
//   let commma3 = num3.toLocaleString();
//   let commma4 = num4.toLocaleString();
//   // let commma5 = num5.toLocaleString();
//   console.log(commma1);
//   $("#price_1").text("¥"+commma1);
//   $("#price_2").text("¥"+commma2);
//   $("#price_3").text("¥"+commma3);
//   $("#price_4").text("¥"+commma4);
  // $("#price_5").text("¥"+commma5);

// console.log(num);
// let en = "¥";
// let enArrey = num.split(en);
// let en1 = enArrey[0];

// console.log(enArrey);
// let comma= num.toLocaleString(); 
// console.log(comma);

// ------------------
// トップに戻る
// ------------------
let pagetopBtn = $('#pagetop');
    pagetopBtn.hide();
 
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            pagetopBtn.fadeIn();
        } else {
            pagetopBtn.fadeOut();
        }
    });
 
    $(window).scroll(function () {
        let height = $(document).height();
        let position = $(window).height() + $(window).scrollTop();
        let footer = $("footer").outerHeight();
        if ( height - position  < footer ) {
            pagetopBtn.css({
                bottom : footer
            });
        } else {
            pagetopBtn.css({
                position : "fixed",
                bottom: 10
            });
        }
    });
    pagetopBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });



// ------------------
// 文字数カウント ※ついでにローカルストレージ保存
// 【課題】スマホでローカルストレージからテキスト表示すると文字カウントできてない
// ------------------

$(function(){
  let getWho = localStorage.getItem("who");
  let getTitle =localStorage.getItem("title");
  $('#who').val(getWho);
  $('#title').val(getTitle);
  $('#who').keyup(function(){
    let who = $(this).val();
    let count = $(this).val().length;
    localStorage.setItem("who", who);
    $('.name-count').text(count);
  });
  $('#title').keyup(function(){
    let title = $(this).val();
    let count = $(this).val().length;
    localStorage.setItem("title", title);
    $('.show-count').text(count);
  });
});

// ------------------
// バリデーション
// 【課題】スマホでmaxlength以上の文字数をローカルストレージに保存→呼び出しできてしまう
// ------------------
// ------------------
// スマホでうまくいかない
// let getWho = localStorage.getItem("who");
// let getTitle =localStorage.getItem("title");
// let getWhoCount = getWho.length;
// let getTitleCount = getTitle.length;
//     if (getWhoCount <= 10) {
//         $('#who').val(getWho);
//     }else{
// 　   let who = getWho.substring(0, 10);
//       $('#who').val(who);
//     }
//     if (getTitleCount <= 42) {
//         $('#title').val(getTitle);
//     }else{
// 　   let title = getTitle.substring(0, 42);
//       $('#title').val(title);
//     }





// ------------------
// モーダル
// ------------------
$('.theme').click(function(){
    $('.modal').addClass('modal_off').removeClass('modal');
    $('.modal_off',this).addClass('modal').removeClass('modal_off');
  });
  $('.close').click(function(){
    event.stopPropagation();
    $(this).parent().addClass('modal_off').removeClass('modal');
  });


// ------------------
// 固定表示
// ------------------
let navPos = $( '#select' ).offset().top; // グローバルメニューの位置
let navPos2 = $( '#tab' ).offset().top; // グローバルメニューの位置
let navHeight = $( '#select' ).outerHeight(); // グローバルメニューの高さ
let navHeight2 = $( '#tab' ).outerHeight(); // グローバルメニューの高さ

$( window ).on( 'scroll', function() {
  if ( $( this ).scrollTop() > navPos2 ) {
    $( 'body' ).css( 'padding-top', navHeight+navHeight2 );
    $( '#select' ).addClass( 'm_fixed' );
    $( '#tab' ).addClass( 'fixed' );
  } else {
    $( 'body' ).css( 'padding-top', 0 );
    $( '#select' ).removeClass( 'm_fixed' );
    $( '#tab' ).removeClass( 'fixed' );
  }
});


// ------------------
// ページ表示でローカルストレージのデータを表示する
// ------------------
// nullがなければボタン出す部分追加すれば下記でも動く
// let getval = {};
// for (let i = 1; i <= 5; i++) {
//   getval[i] = JSON.parse(localStorage.getItem("item" + i));
// }

// $(function(){
// for (let i = 1; i <= 5; i++) {
//   if(localStorage.hasOwnProperty('item' + i)) {
//     $('#item' + i).attr('src', getval[i].img);
//     $('#img' + i).attr('value', getval[i].img);
//     $('#url' + i).attr('value', getval[i].url);
//     $('#price' + i).attr('value', getval[i].price);
//     $('#genre' + i).attr('value', getval[i].cate);
//     $('.attention').text("※選択済み画像を押すと選択を解除できます");
//   }
// }
// });



let get1 = JSON.parse(localStorage.getItem("item1"));
let get2 = JSON.parse(localStorage.getItem("item2"));
let get3 = JSON.parse(localStorage.getItem("item3"));
let get4 = JSON.parse(localStorage.getItem("item4"));
let get5 = JSON.parse(localStorage.getItem("item5"));

$(function(){
    if(get1 !== null!== null && get3 !== null && get4 !== null){
    $('#submit').attr('type', "submit");
    console.log("OK");
  }
if(localStorage.hasOwnProperty('item1')) {
  $('#item1').attr('src', get1.img);
  $('#img1').attr('value', get1.img);
  $('#url1').attr('value', get1.url);
  $('#price1').attr('value', get1.price);
  $('#genre1').attr('value', get1.cate);
  $('.attention').text("※選択済み画像を押すと選択を解除できます");
}
if(localStorage.hasOwnProperty('item2')) {
  $('#item2').attr('src', get2.img);
  $('#img2').attr('value', get2.img);
  $('#url2').attr('value', get2.url);
  $('#price2').attr('value', get2.price);
  $('#genre2').attr('value', get2.cate);
  $('.attention').text("※選択済み画像を押すと選択を解除できます");
}
if(localStorage.hasOwnProperty('item3')) {
  $('#item3').attr('src', get3.img);
  $('#img3').attr('value', get3.img);
  $('#url3').attr('value', get3.url);
  $('#price3').attr('value', get3.price);
  $('#genre3').attr('value', get3.cate);
  $('#attention').text("※選択済み画像を押すと選択を解除できます");
}
if(localStorage.hasOwnProperty('item4')) {
  $('#item4').attr('src', get4.img);
  $('#img4').attr('value', get4.img);
  $('#url4').attr('value', get4.url);
  $('#price4').attr('value', get4.price);
  $('#genre4').attr('value', get4.cate);
  $('.attention').text("※選択済み画像を押すと選択を解除できます");
}
if(localStorage.hasOwnProperty('item5')) {
  $('#item5').attr('src', get5.img);
  $('#img5').attr('value', get5.img);
  $('#url5').attr('value', get5.url);
  $('#price5').attr('value', get5.price);
  $('#genre5').attr('value', get5.cate);
  $('.attention').text("※選択済み画像を押すと選択を解除できます");
}
});

// ------------------
// クリックで商品画像追加
// ------------------
let default_src =$('.default').attr('src');
$(window).on('load',function(){

  $('.item').on('click', function(){ 
    let img = $('.img',this).attr('src');
    let url = $('.url',this).attr('href');
    let price = $('.price',this).data('id');
    let cate = $('.cateEn',this).data('id');
    let item1 = $('#item1').attr('src');
    let item2 = $('#item2').attr('src');
    let item3 = $('#item3').attr('src');
    let item4 = $('#item4').attr('src');
    let item5 = $('#item5').attr('src');
    $('.attention').text("※選択済み画像を押すと選択を解除できます");
    if(item1 ===default_src){
      $('#item1').attr('src', img);
      $('#img1').attr('value', img);
      $('#url1').attr('value', url);
      $('#price1').attr('value', price);
      $('#genre1').attr('value', cate);
      let datalist1 = {img,url,price,cate};
      localStorage.setItem("item1", JSON.stringify(datalist1));
      if(item4 !==default_src&&item3 !==default_src&&item2 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item2 ===default_src){
      $('#item2').attr('src', img);
      $('#img2').attr('value', img);
      $('#url2').attr('value', url);
      $('#price2').attr('value', price);
      $('#genre2').attr('value', cate);
      let datalist2 = {img,url,price,cate};
      localStorage.setItem("item2", JSON.stringify(datalist2));
      if(item4 !==default_src&&item3 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item3 ===default_src){
      $('#item3').attr('src', img);
      $('#img3').attr('value', img);
      $('#url3').attr('value', url);
      $('#price3').attr('value', price);
      $('#genre3').attr('value', cate);
      let datalist3 = {img,url,price,cate};
      localStorage.setItem("item3", JSON.stringify(datalist3));
      if(item4 !==default_src){
        $('#submit').attr('type', "submit");
      }
    }else if(item4 === default_src){
      $('#item4').attr('src', img);
      $('#img4').attr('value', img);
      $('#url4').attr('value', url);
      $('#price4').attr('value', price);
      $('#genre4').attr('value', cate);
      let datalist4 = {img,url,price,cate};
      localStorage.setItem("item4", JSON.stringify(datalist4));
      // if(item5 !==default_src){
        $('#submit').attr('type', "submit");
      // }
    }else if(item5 ===default_src){
      $('#item5').attr('src', img);
      $('#img5').attr('value', img);
      $('#url5').attr('value', url);
      $('#price5').attr('value', price);
      $('#genre5').attr('value', cate);
      let datalist5 = {img,url,price,cate};
      localStorage.setItem("item1", JSON.stringify(datalist5));
      $('#submit').attr('type', "submit");
    }else{
      $('#submit').attr('type', "submit");
    }
  });
  
   $('#item1').on('click', function (){
      $(this).attr('src',default_src);
      $('#img1').attr('value', default_src);
      $('#url1').attr('value', "");
      $('#price1').attr('value', "");
      $('#genre1').attr('value', "");
      localStorage.removeItem("item1");
      $('#submit').attr('type', "hidden");
    })
    $('#item2').on('click', function(){
      $(this).attr('src',default_src);
      $('#img2').attr('value', default_src);
      $('#url2').attr('value', "");
      $('#price2').attr('value', "");
      $('#genre2').attr('value', "");
      localStorage.removeItem("item2");
      $('#submit').attr('type', "hidden");
    })
    $('#item3').on('click', function(){
      $(this).attr('src',default_src);
      $('#img3').attr('value', default_src);
      $('#url3').attr('value', "");
      $('#price3').attr('value', "");
      $('#genre3').attr('value', "");
      localStorage.removeItem("item3");
      $('#submit').attr('type', "hidden");
    })
    $('#item4').on('click', function(){
      $(this).attr('src',default_src);
      $('#img4').attr('value', default_src);
      $('#url4').attr('value', "");
      $('#price4').attr('value', "");
      $('#genre4').attr('value', "");
      localStorage.removeItem("item4");
      $('#submit').attr('type', "hidden");
    })
    $('#item5').on('click', function(){
      $(this).attr('src',default_src);
      $('#img5').attr('value', default_src);
      $('#url5').attr('value', "");
      $('#price5').attr('value', "");
      $('#genre5').attr('value', "");
      localStorage.removeItem("item5");
      // $('#submit').attr('type', "hidden");
    })
});



// 決定押したらローカルストレージ消す。フォームバリデーションに引っ掛かったときの対処は考慮してない
$('#submit').on('click', function(){
  localStorage.clear();
});



// ------------------
// タブスワイプ＆
// ページネーションした時にパラメーターとってタブスワイプのカレント変える
// https://www.tam-tam.co.jp/tipsnote/javascript/post9911.html
// https://hajimete.org/jquery-subsequent-string-deletion
// ------------------

$(window).on('load',function(){

function current(n) {
//初期化
var galleryThumbs = new Swiper('.tab-menu', {
    initialSlide: n,
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
    initialSlide: n,
    autoHeight: true,
    // autoHeight: false,
    thumbs: {
      swiper: galleryThumbs
    }
  });
  return n;
}

// URLのパラメータを取得
let urlParam = location.search.substring(1);
let cut = "=";
let paramArrey = urlParam.split(cut);
let paramName = paramArrey[0];
console.log(paramName);
let n = 0;
  if (paramName === 'tops') {
    n = 0;
  } else if(paramName === 'bottoms') {
    n = 1;
  } else if(paramName === 'onepiece') {
    n = 2;
  } else if(paramName === 'allinone') {
    n = 3;
  } else if(paramName === 'outer') {
    n = 4;
  } else if(paramName === 'shoes') {
    n = 5;
  } else if(paramName === 'bag') {
    n = 6;
  } else if(paramName === 'accessory') {
    n = 7;
  } else if(paramName === 'jewelry') {
    n = 8;
  }
current(n);
});



// ------------------
// 無限スクロール
// https://mrkmyki.com/laravel%E3%81%AEpaginate%E3%81%A8infinite-scroll%E3%82%92%E4%BD%BF%E3%81%84%E3%80%81%E3%83%87%E3%83%BC%E3%82%BF%E3%83%99%E3%83%BC%E3%82%B9%E5%86%85%E3%81%AE%E3%83%87%E3%83%BC%E3%82%BF%E3%82%92
// https://on-ze.com/archives/2486
// https://github.com/metafizzy/infinite-scroll
// ------------------

