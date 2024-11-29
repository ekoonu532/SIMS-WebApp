<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10; 
        $search = $request->input('search');
        $filter = $request->input('filter');

        $query = DB::table('products as p')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->select('p.*', 'c.nama as category_name')
            ->orderBy('p.id', 'asc');;

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('p.name', 'like', "%{$search}%")
                    ->orWhere('c.nama', 'like', "%{$search}%");
            });
        }

        if (!empty($filter) && $filter !== 'Semua') {
            $query->where('p.category_id', $filter);
        }


        $products = $query->paginate($perPage)->appends([
            'search' => $search,
            'filter' => $filter,
        ]);
     

        $categories = DB::table('categories')->get();

        return view('pages.products', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'filter' => $filter,
        ]);
    }





    public function export(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');

        return Excel::download(new ProductsExport($search, $filter), 'products.xlsx');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = DB::table('categories')->get();
        return view('pages.addProduct',  ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $validated = $request->validated();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            $path = public_path('storage/products');


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }


            $image->move($path, $filename);

            $validated['image'] = 'storage/products/' . $filename;
        }


        DB::table('products')->insert([
            'name' => $validated['name'],
            'purchase_price' => $validated['purchase_price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'image' => $validated['image'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product =  DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();

        return view('pages.editProduct', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $prod = DB::table('products')->where('id', $id)->first();

        $data = [
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            if ($prod->image && Storage::exists('public/' . $prod->image)) {
                Storage::delete('public/' . $prod->image);
            }
            $image = $request->file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            $path = public_path('storage/products');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);

            $prod->image = 'storage/products/' . $filename;
        }

        DB::table('products')
            ->where('id', $id)
            ->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prod = DB::table('products')->where('id', $id)->first();

        if ($prod->image && Storage::exists('public/' . $prod->image)) {
            Storage::delete('public/' . $prod->image);
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
