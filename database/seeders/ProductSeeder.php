<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Company;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 最初に会社データを作成
        // $company = Company::create([
        //     'company_name' => 'コカコーラ',
        //     'company_address' => '東京都',
        //     'representative_name' => '佐藤太郎',
        // ]);

        // // 作成した会社のIDを使って商品を作成
        // Product::create([
        //     'product_name' => 'コカコーラゼロ',
        //     'price' => 100,
        //     'stock' => 50,
        //     'comment' => 'これはダミーの商品です。',
        //     'img_path' => '商品画像',
        //     'company_id' => $company->id, // 作成した会社のIDを設定
        // ]);
    }
}

