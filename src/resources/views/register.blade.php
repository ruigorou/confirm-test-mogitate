@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<form class="form" action="/products/register" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <h2>商品登録</h2>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">商品名</span>
            <span class="form__label--required">必須</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}"/>
            </div>
            <div class="form__error">
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">値段</span>
            <span class="form__label--required">必須</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--text">
              <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}"/>
            </div>
            <div class="form__error">
                @foreach($errors->get('price') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">商品画像</span>
            <span class="form__label--required">必須</span>
        </div>
        <div class="form__group-content">
            <img id="preview" src="">
            <div class="label-group">
                <label class="image-label" for="image">ファイルの選択</label>
                <span id="file-name"></span>
            </div>
            <div class="form__input--image">
              <input id="image" class="image-file"  type="file" name="image"  accept=".png, .jpeg"/>
            </div>
            <div class="form__error">
                @foreach($errors->get('image') as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">季節</span>
            <span class="form__label--required">必須</span>
            <span class="form__label--text">複数選択可</span>
        </div>
        <div class="form__group-content">
            <div class="form__checkbox--group">
                @php
                    $oldSeasons = old('seasons', $selectedSeasonIds ?? []);
                @endphp

                @foreach ([1 => '春', 2 => '夏', 3 => '秋', 4 => '冬'] as $id => $label)
                    <label>
                        <input type="checkbox" name="seasons[]" value="{{ $id }}"
                        {{ in_array($id, $oldSeasons) ? 'checked' : '' }}>
                        {{ $label }}
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
    <div class="form__group">
        <div class="form__group-title">
            <span class="form__label--item">商品説明</span>
            <span class="form__label--required">必須</span>
        </div>
        <div class="form__group-content">
            <div class="form__input--textarea">
                <textarea name="description" placeholder="商品説明を入力">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="form__error">
            @foreach($errors->get('description') as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
    <div class="form__button">
        <div class="form__button-back">
            <a href="{{ route('index') }}">戻る</a>
        </div>
        <div class="form__button-submit">
            <button type="submit">登録</button>
        </div>
    </div>
</form>
<script src="{{ asset('js/image-preview.js') }}"></script>
@endsection