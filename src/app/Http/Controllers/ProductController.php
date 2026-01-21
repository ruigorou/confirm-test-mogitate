<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Whoops\Run;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\DetailRequest;

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

    public function update(DetailRequest $request){
        $data = $request->only([
            'name', 
            'price', 
            'description', 
            ]);

        $image_data = $request->only([
            'image'
        ]);

        $product = Product::findOrFail($request->id);
        $product = $this->edit($request, $product,  $data, $image_data);
        $this->seasons_edit($request, $product);

        return redirect("/products/detail/{$request->id}");
    }

    private function edit($request, $product, $data, $image_data)
    {
        if (!empty($request->image)) {
            $product->update($image_data);
        }
        $product->update($data);
        return $product;
    }

    private function seasons_edit(Request $request, Product $product) {
        $season_ids = $request->input('seasons', []);
        $product->seasons()->sync($season_ids); 
    }

    public function destroy(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/products');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function store(RegisterRequest $request) {
        $deta = $request->only([
            'name',
            'price',
            'description'
        ]);

        if ($request->hasFile('image')) { 
            $path = $request->file('image')->store('public/image/products');
            $deta['image'] = basename($path);
        }
        
        $product = Product::create($deta);
        $product->seasons()->sync($request->input('seasons', []));
        return redirect()->route('index');
    }
}
