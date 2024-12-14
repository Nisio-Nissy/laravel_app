<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company; // モデルをインポート

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $company_id = $request->input('company_id');
    
        // 検索クエリの処理
        $query = Product::with('company');

        $query->search($search);
    
        if (!empty($company_id)) {
            $query->where('company_id', $company_id);
        }
    

        // 商品一覧データを取得 (ページネーション付き)
        $products = $query->paginate(3);
    
        // 企業リストを取得
        $companies = \App\Models\Company::all();

        //dd($query->toSql(), $query->getBindings());
    
        // ビューにデータを渡す
        return view('products.index', compact('products','search','companies', 'company_id'));
    }
    


    public function create(){

       // 会社のリストを取得
        $companies = Company::all();
        
        // ビューに渡す
        return view('products.create', compact('companies'));


    }


    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'company_id' => 'required|exists:companies,id', 
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
        ]);
    
        // メーカー名が送信されていれば、それに基づいて会社を作成
        // $company = Company::firstOrCreate([
        //     'company_name' => $request->company_name,
        // ]);
    
        // 商品を作成
        $product = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'company_id' =>$request->company_id, // 作成した会社のIDを設定
        ]);

        \App\Models\Sale::create([
            'product_id' => $product->id,
        ]);
    
        // 自画面へリダイレクト
        return redirect()->route('products.create')->with('success', '商品を登録しました！');
    }
    

    public function show($id)
        {
            // 商品をIDで検索
            $product = Product::findOrFail($id);

            // 詳細ページを表示
            return view('products.show', compact('product'));
        }
    public function edit($id)
        {
            // 商品をIDで取得
            $product = Product::findOrFail($id);
            $companies = Company::all();
        
            // 編集フォームを表示
            return view('products.edit', compact('product', 'companies'));
        }
    
        public function update(Request $request, $id)
        {
            // バリデーションを行う
            $request->validate([
                'product_name' => 'required|string|max:255',
                'price' => 'required|integer',
                'company_id' => 'required|exists:companies,id',
                'stock' => 'required|integer',
                'comment' => 'nullable|string',
                'img_path' => 'nullable|string|max:255',
            ]);
        
            // 商品をIDで取得して更新
            $product = Product::findOrFail($id);


            $product->update([
                'product_name' => $request->input('product_name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'comment' => $request->input('comment'),
                'img_path' => $request->input('img_path'),
                'company_id' => $request->input('company_id') // 会社のIDを更新
            ]);
        
            // 更新後、自画面にリダイレクト
            return redirect()->route('products.edit', ['id' => $id])->with('success', '商品情報が更新されました。');
        }

        public function destroy($id)
        {
            // 商品を取得して削除
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.index')->with('success', '商品が削除されました。');
        }

        

}

