<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function destroy($id)
    {
        $products = Product::where('company_id', $id)->count();

        if ($products > 0) {
            return redirect()->back()->with('error', 'このメーカーには関連する商品があるため削除できません。');
        }

        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'メーカーが削除されました。');
    }
}