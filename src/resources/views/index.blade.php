@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
    <div class="subtitle">
         <h2>商品一覧</h2>
         <a  class="add_product" href="">＋商品を追加</a>
    </div>
    <div class="content">
        <div class="content__form">
            <form class="search_form" action="/products/search" method="GET">
            @csrf
                <input class="search_category__input" type="text" name="name" placeholder="商品名で検索">
                <button class="search_category__btn" type="submit">検索</button>
            </form>
            <form action="{{ route('index') }}" method="GET">
                @csrf
                <input type="hidden" name="name" value="{{ request('name') }}">
                <p>価格で表示</p>
                <select class="sort_by_price" name="sort" onchange="this.form.submit()">
                    <option disabled selected>価格で並び替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格が安い順に表示</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格が高い順に表示</option>
                </select>
                @if(request('sort'))
                    <div class="sort-condition">
                        <span>
                            {{ request('sort') === 'asc' ? '価格が安い順に表示' : '価格が高い順に表示' }}
                        </span>
                        <a href="{{ route('index', array_merge(request()->except('sort'), ['page' => 1])) }}" class="close-btn">×</a>
                    </div>
                @endif
            </form>
        </div>
        <article>
            @foreach ($products as $product)
                <div class="product_card">
                    <div class="product_card__img">
                        <a href="{{ route('products.detail' ,['id'=> $product->id]) }}">
                            <img src="{{  asset('storage/image/products/' . $product->image)  }}" alt="{{ $product->name }}">
                        </a>
                    </div>
                    <div class="product_card__title">
                        <p>{{ $product->name }}</p>
                        <p>¥{{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </article>
    </div>
    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection