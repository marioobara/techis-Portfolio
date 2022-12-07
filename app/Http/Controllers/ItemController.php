<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
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
    public function home()
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

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();
        $type_id='';
        return view('item.index', compact('items','type_id'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'stock' => 'required|max:100',
            ]);
            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'stock' => $request->stock,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    //削除
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();

        return redirect('/items');
    }

    public function edit(Request $request)
    {
        $item = Item::where('id', '=', $request->id)->first();

        return view('item.edit')->with([
            'item' => $item,
        ]);
    }

    public function itemEdit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'detail' => 'nullable|MAX:500',
        ]);

        $item = Item::where('id', '=', $request->id)->first();
        $item->name = $request->name;
        $item->type = $request->type;
        $item->stock = $request->stock;
        $item->detail = $request->detail;
        $item->save();

        return redirect('/store');
    }
    public function itemStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'detail' => 'nullable|MAX:500',
        ]);

        // 商品登録
        Item::create([
            'name' => $request->name,
            'type' => $request->type,
            'stock' => $request->stock,
            'detail' => $request->detail,
            'user_id' => Auth::id()

        ]);

        return redirect('/');
    }

}
