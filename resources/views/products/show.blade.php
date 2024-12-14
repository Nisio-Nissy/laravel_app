@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>商品詳細</h1>

        <table class="table">
            <tr>
                <th>商品ID</th>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <th>商品名</th>
                <td>{{ $product->product_name }}</td>
            </tr>
            <tr>
                <th>メーカー名</th>
                <td>{{ $product->company->company_name ?? '未設定' }}</td> <!-- company_name を表示 -->
            </tr>
            <tr>
                <th>価格</th>
                <td>{{ $product->price }}</td>
            </tr>
            <tr>
                <th>在庫</th>
                <td>{{ $product->stock }}</td>
            </tr>
            <tr>
                <th>コメント</th>
                <td>{{ $product->comment }}</td>
            </tr>
            <tr>
                <th>画像パス</th>
                <td>{{ $product->img_path }}</td>
            </tr>
        </table>

        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">編集</a>
        <!-- 戻るボタン -->
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </div>
@endsection
