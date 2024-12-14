<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            ['company_name' => 'コカコーラ', 'company_address' => '住所A', 'representative_name' => '代表者A', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'サントリー', 'company_address' => '住所B', 'representative_name' => '代表者B', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'ABC飲料', 'company_address' => '住所C', 'representative_name' => '代表者C', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
