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
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
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
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
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
        $item = Item::where('id', '=', $request->id)->first();
        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->save();

        return redirect('/store');
    }
    public function itemStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'nullable|numeric',
            'detail' => 'nullable|MAX:500',
        ]);

        // 商品登録
        Item::create([
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
            'user_id' => Auth::id()

        ]);

        return redirect('/');
    }

}
