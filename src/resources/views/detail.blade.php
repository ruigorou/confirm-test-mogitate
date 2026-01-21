@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection
@section('content')

    <nav class="breadcrumb">
        <a href="{{ route('index') }}">商品一覧</a>
        <span> &gt; </span>
        <span>{{ $product->name }}</span>
    </nav>
    <form action="/products/{{ $product->id }}/update" class="contents" method="post">
        @csrf
        @method('put')
        <div class="detail_form">
            <div class="detail_image">
                 <img id="preview" src="{{ asset('storage/image/products/'. $product->image) }}">
                 <div class="file-row">
                    <label class="image-label" for="image">ファイルの選択</label>
                    <span id="file-name" class="file-name">{{ $product->image }}</span>
                 </div>
                <input class="image-file" type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="detail_input">
                <label class="detail_label">商品名</label>
                <input type="text" name="name" value="{{ $product->name }}">
                <div class="form__error">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <label class="detail_label">値段</label>
                <input type="text" name="price" value="{{ $product->price }}">
                <div class="form__error">
                    @foreach($errors->get('price') as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                <label class="detail_label">季節</label>
                <div class="detail_checkbox_group">
                    @foreach ([1 => '春', 2 => '夏', 3 => '秋', 4 => '冬'] as $id => $label)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $id }}" {{ in_array($id, old('seasons', $selectedSeasonIds ?? [])) ? 'checked' : '' }}> {{ $label }}
                        </label>
                    @endforeach
                </div>
                <div class="form__error">
                    @if($errors->get('seasons'))
                        <div class="error">{{ $errors->first('seasons') }}</div>
                    @endif
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
            <div class="form__error">
                @foreach($errors->get('description') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <div class="button-group">
                <div class="button-group__center">
                    <a class="button-group__previous-screen" href="{{ route('index') }}">戻る</a>
                    <button class="update-form__btn" type="submit">変更を保存</button>
                </div>
                <div class="button-group__right">
                </div>
            </div>
        </div>
    </form>
    <form class="delete-form" action="/products/{{ $product->id }}/delete" method="post" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('delete')
        <button class="delete-form__delete-btn">
            <i class="fa-solid fa-trash-can"></i>
        </button>
    </form>
    <script src="{{ asset('js/image-preview.js') }}"></script>
@endsection