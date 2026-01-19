@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection
@section('content')
    <div>
        ルート表示
    </div>
    <div class="contents">
        <div class="detail_form">
             <div class="detail_image">
                <img src="{{ asset('storage/image/products/'. $product->image) }}" alt="{{ $product->name }}">
                <div class="file">
                    <label for="file-input" class="file-label">ファイルを選択</label> {{ $product->image }}
                    <input class="file-input" type="file" name="image" id="file-input">
                </div>
            </div>
            <div class="detail_input">
                <label class="detail_label">商品名</label>
                <input type="text" value="{{ $product->name }}">
                <label class="detail_label">値段</label>
                <input type="text" value="{{ $product->price }}">
                <label class="detail_label">季節</label>
                <div class="detail_checkbox_group">
                    @foreach ([1 => '春', 2 => '夏', 3 => '秋', 4 => '冬'] as $id => $label)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $id }}" {{ in_array($id, old('seasons', $selectedSeasonIds ?? [])) ? 'checked' : '' }}> {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="datail-textarea">
            <div class="textarea-label">
                 <label>商品説明</label>
            </div>
            <div>
                <textarea id="description"  name="description" rows="5" cols="40">{{ old('description', $product->description ?? '')}}
                </textarea>
            </div>
            
            <div class="button-group">
                <a class="button-group__previous-screen" href="/products">戻る</a>
                <button class="button-group__update">変更を保存</button>
                <input type="submit" value="削除">
            </div>
        </div>
    </div>
@endsection