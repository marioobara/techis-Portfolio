<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store(Request $request) //（）の中に記述することによりviewで指定している情報(formのリクエスト)を元に値を取得する
    {

        $keyword = $request->input('keyword');
        $type_id = $request->input('type_id');
        //keywordとはviewに記載している（form）の値を参照


        $query = Item::query();
        //ItemというDB（itemContoller）に情報を取りに行く。


        if(!empty($keyword)) {//$keywordが空じゃない時に下記を実施
            $query->where('name', 'LIKE', "%{$keyword}%");

        }//whereメソッドでLIKE検索を指定し、$keywordの両側に%をつけることで、部分一致検索を行います。またorWhereメソッドでOR検索を行います。
        if(!empty($type_id)) {//$keywordが空じゃない時に下記を実施
            $query->where('type', '=',$type_id);
        }//whereメソッドでLIKE検索を指定し、$keywordの両側に%をつけることで、部分一致検索を行います。またorWhereメソッドでOR検索を行います。

        $items = $query->get(); //$queryの値を全て取ってくる


        // $items = Item::all();
        return view('item.index', [//viewで表示したいbladeを記述（item.indexと記述することによりview/item/index.blade.phpとなる）
            'items' => $items,
            'type_id' =>$type_id,
            //itemsの中に$items（44行目）の引数を渡す
        ]);
    }
}
