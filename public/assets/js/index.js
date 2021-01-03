/* global $ */
/* global jQuery */
// ------------------
// クリックで商品画像追加
// ------------------

$(window).on('load',function(){
  let default_src =$('.item').attr('src');
  $(document).on('click', '.item', function(){  
    let img = $('.img',this).attr('src');
    let url = $('.url',this).attr('href');
    let price = $('.price',this).data('id');
    console.log(default_src);
    let item1 = $('#item1').attr('src');
    let item2 = $('#item2').attr('src');
    let item3 = $('#item3').attr('src');
    let item4 = $('#item4').attr('src');
    let item5 = $('#item5').attr('src');
    // let item6 = $('#item6').attr('src');
    if(item1 ===default_src){
      $('#item1').attr('src', img);
      $('#img1').attr('value', img);
      $('#url1').attr('value', url);
      $('#price1').attr('value', price);
    }else if(item2 ===default_src){
      $('#item2').attr('src', img);
      $('#img2').attr('value', img);
      $('#url2').attr('value', url);
      $('#price2').attr('value', price);
    }else if(item3 ===default_src){
      $('#item3').attr('src', img);
      $('#img3').attr('value', img);
      $('#url3').attr('value', url);
      $('#price3').attr('value', price);
    }else if(item4 === default_src){
      $('#item4').attr('src', img);
      $('#img4').attr('value', img);
      $('#url4').attr('value', url);
      $('#price4').attr('value', price);
      $('#submit').attr('type', "submit");
    }else if(item5 ===default_src){
      $('#item5').attr('src', img);
      $('#img5').attr('value', img);
      $('#url5').attr('value', url);
      $('#price5').attr('value', price);
    // }else if(item6 ===default_src){
    //   $('#item6').attr('src', img);
    //   $('#img6').attr('value', img);
    //   $('#url6').attr('value', url);
    //   $('#price6').attr('value', price);
    }else{
      $('#submit').attr('type', "submit");
    }
  $('#item1').on('click', function(){
      $(this).attr('src',default_src);
      $('#img1').attr('value', default_src);
      $('#url1').attr('value', "");
      $('#price1').attr('value', "");
    })
    $('#item2').on('click', function(){
      $(this).attr('src',default_src);
      $('#img2').attr('value', default_src);
      $('#url2').attr('value', "");
      $('#price2').attr('value', "");
    })
    $('#item3').on('click', function(){
      $(this).attr('src',default_src);
      $('#img3').attr('value', default_src);
      $('#url3').attr('value', "");
      $('#price3').attr('value', "");
    })
    $('#item4').on('click', function(){
      $(this).attr('src',default_src);
      $('#img4').attr('value', default_src);
      $('#url4').attr('value', "");
      $('#price4').attr('value', "");
    })
    $('#item5').on('click', function(){
      $(this).attr('src',default_src);
      $('#img5').attr('value', default_src);
      $('#url5').attr('value', "");
      $('#price5').attr('value', "");
    })
    // $('#item6').on('click', function(){
    //   $(this).attr('src',default_src);
    //   $('#img6').attr('value', default_src);
    //   $('#url6').attr('value', "");
    //   $('#price6').attr('value', "");
    // })  

  });

});



// ------------------
// 下部固定メニュー
// // ------------------
// jQuery(function() {
//     var topBtn = jQuery('.footer-menu');
//     topBtn.hide();
//     jQuery(window).scroll(function () {
//         if (jQuery(this).scrollTop() > 100) { // 200pxで表示
//             topBtn.fadeIn();
//         } else {
//             topBtn.fadeOut();
//         }
//     });
// });
