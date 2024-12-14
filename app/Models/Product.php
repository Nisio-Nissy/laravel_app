<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ]; 

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);          
    }


    public function scopeSearch($query, $search)
        {
        if($search !== null){
            $search_split = mb_convert_kana($search, 's'); // 全角スペースを半角
            $search_split2 = preg_split('/[\s]+/', $search_split); //空白で区切る
            foreach( $search_split2 as $value ){
            $query->where('product_name', 'like', '%' .$value. '%'); }
            }

         return $query;
        }


}


