@extends('layouts.app')

@section('title', '商品一覧') <!-- タイトルのカスタマイズ -->

@section('content')
<div class="container">
        <h1>商品一覧</h1>
        <form method="GET" action="{{ route('products.index') }}">
            <div class="form-group">

                <!-- テキストボックス検索 -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="商品名を検索" class="form-control mb-3">

                <!-- メーカー名のセレクトボックス -->
                <select name="company_id" class="form-control mb-3">
                    <option value="">全てのメーカー</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" 
                            {{ request('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
                
                <!-- 検索ボタン -->
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>

        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>画像画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫</th>
                <th>コメント</th>
                <th>メーカー名</th>    
                <th>
                    <a href="{{ route('products.create') }}" class="btn btn-warning">新規登録</a>
                </th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->img_path }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->comment }}</td>
                    
                    <td>
                        @php
                            // company_idを使ってCompanyモデルからデータを取得
                            $company = \App\Models\Company::find($product->company_id);
                        @endphp
                        {{-- $companyがnullでないかをチェック --}}
                        {{ $company ? $company->company_name : '未登録' }} <!-- companyが存在しない場合には'未登録'を表示 -->
                    </td>

                   <td><a href="{{ route('products.show', $product->id) }}" class="btn btn-info">詳細</a></td>

                    <td>
                        <!-- 削除ボタン -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>     
                </tr>
            @endforeach
            </tbody>
             </table>
             {{ $products->links('vendor.pagination.bootstrap-5') }}
</div>

@endsection
