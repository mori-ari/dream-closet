<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //この行を上に追加チームモデルの呼び出し
use App\Item;//この行を上に追加
use Validator;//この行を上に追加　バリデーションの呼び出し

class CategoriesController extends Controller
{

    public function index()
    {
    //
    //カテゴリ 全件取得
    $categories = Category::get();        
    return view('categories',[
    'categories'=> $categories
]);

    }
    
}
