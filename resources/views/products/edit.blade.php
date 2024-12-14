@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>商品編集</h1>

        <!-- 編集フォーム -->
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- PUT メソッドを使用して更新処理を行う -->

            <div class="mb-3">
                <label for="product_name" class="form-label">商品ID</label>
                <br>
                {{ $product->id }}
            </div>
            
            <div class="mb-3">
                <label for="product_name" class="form-label">商品名<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="company_id" class="form-label">メーカー名<span class="text-danger">*</span></label>
                <select class="form-select" id="company_id" name="company_id" required>
                    <option value="">メーカーを選択してください</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" 
                            {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">価格<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">在庫数<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">コメント</label>
                <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $product->comment) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="img_path" class="form-label">商品画像</label>
                <input type="file" class="form-control" id="img_path" name="img_path" accept="image/* value="{{ old('img_path', $product->img_path) }}">
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
        </form>
    </div>
@endsection
