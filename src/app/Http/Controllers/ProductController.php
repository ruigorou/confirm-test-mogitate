<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Whoops\Run;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();
        $query = $this->price_sort($request, $query);
        $products = $query->paginate(6)->appends($request->query());
        return view("index", compact("products"));
    }

    public function search(Request $request){
        $query = Product::query();
        $query = $this->product_search($request, $query);
        $query = $this->price_sort($request, $query);

        $products = $query->paginate(6)->appends($request->query());
        return view("search", compact("products"));
    }

    public function detail($id) {
        $product = Product::findOrFail($id);
        $selectedSeasonIds = $product->seasons->pluck('id')->toArray();
        return view("detail", compact("product", "selectedSeasonIds"));
    }

    public function product_search($request, $query){
        if(!empty($request->name)){
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        return $query;
    }

    public function price_sort($request, $query){
        if($request->sort === 'asc'){
            $query->orderBy('price','asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('price', 'desc');
        }
        return $query;
    }
}
