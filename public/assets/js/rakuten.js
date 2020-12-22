/* global $ */

// ------------------
// グローバル変数
// ------------------
let APPID = "1027306534650996418"; //アプリID *必須
let AFF = "1d1234e2.3dc1e4f6.1d1234e3.4f94fc78";
let MAX_PAGE = 100; //最大取得ページ件数
let HITS = 30; //1ページ当たりの表示件数
let GENRE = 555086;
let SHOP = "cocacoca";
let KEYWORD = encodeURIComponent("カラコン"); //絞り込みしたい単語
let SORT = encodeURIComponent("standard"); //レビュー降順
let IMGFLG = 1;
let GENRECOUNT =1;


// ------------------
// 楽天API
// ------------------
$(function () {
  let n = 1;

// スクロールでページ追加
  $(window).bind("scroll", function () {
        let scrollHeight = $(document).height();
        let scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight <= 0.0005) {
            //スクロールの位置が下部0.05％の範囲に来た場合
            if (n < MAX_PAGE) {
              search_rakuten(n+1);
            }
        } else {
            //それ以外のスクロールの位置の場合
            // $('body').css('background', '#eeeeee');
        }
    });


  function put_item(item) {  
  
    // imgId=;
    // urlId=;
    let h = '<div class="item">'
        + '<img src="'
        + item.mediumImageUrls[0].imageUrl.replace("?_ex=128x128","")
        + '" class="img">'
        + '<span><a href="'
        + item.affiliateUrl
        + '" class="url" target="_blank">商品リンク</a></span><span class="price" data-id="'
        + item.itemPrice
        + '">'
        + item.itemPrice
        +'</span></div>';

    //ループで表示したいHTML部分を作成 
    $("#api").append(h);
      // `         
      // `
 

    // <div>
    // <img src="item.mediumImageUrls[0].imageUrl.replace("?_ex=128x128","")" id="●" class="img">
    // <span><a href="item.affiliateUrl" target="_blank">●</a></span>
    // </div>


  }

  //ajax
  function search_rakuten(page) {
    $.ajax({
      url:
        "https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?format=json&applicationId=" +
        APPID +
        "&affiliateId=" +
        AFF +
        "&shopCode=" +
        SHOP +
        // "&genreId=" +
        // GENRE +
        // "&keyword=" +
        // KEYWORD +
        "&imageFlag=" +
        IMGFLG +
        "&genreInformationFlag=" +
        GENRECOUNT +
        "&sort=" +
        SORT +
        "&page=" +
        page +
        "&hits=" +
        HITS,
      type: "get",
      dataType: "json",
      timeout: 10000,
      async: "true",
    })
      //読み込み成功時の処理
      .done(function (data) {
        // 1商品ずつhtml置く
        for (let i in data.Items) {
          put_item(data.Items[i].Item);
        }
        if (page < MAX_PAGE) {
            search_rakuten(page + 1);
        }
      })
      //読み込み失敗時の処理
      .fail(function (data) {
        console.log("読み込みエラー");
      });
  }
  search_rakuten(n);
  console.log(n);

});

