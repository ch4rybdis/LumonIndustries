<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Image;
use App\Services\LocationService;

use App\Services\IpService;



class ProductController extends Controller
{

    protected $locationService;
    protected $ipService;

    public function __construct(LocationService $locationService, IpService $ipService)
    {
        $this->locationService = $locationService;
        $this->ipService = $ipService;
    }

    public function showLocation(Request $request)
    {
        // IP adresini IpService ile alın
        $ip = $this->ipService->getIp();
        // IP adresine göre konum bilgisini alın
        $location = $this->locationService->getLocation($ip);

        return response()->json($location);
    }

    public function deleteProduct($id)
{
    // İlgili ürünü bul
    $product = Product::where('product_id', $id)->first();



    // Ürünü sil
    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully.');
}
    public function updateImage(Request $request, $id)
{


    $newImage = new Image();
    $newImage->image_link = $request->image_link;
    $newImage->save();

    $product = Product::where('product_id', $id)->first();
    $product->image_id = $newImage->id;
    $product->save();

    return redirect()->route('products')->with('success', 'Image updated successfully');
}
    public function edit($id)
    {
        $product = Product::where('product_id', $id)->first();
        return view('front.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'productName' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $product = Product::where('product_id', $id)->first();

        $product->product_id = $id;
        $product->product_name = $request->productName;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully.');
    }
    public function addProduct(Request $request)
    {
        // Validation işlemleri
        $request->validate([
            'productName' => 'required|string',
            'category' => 'required|integer',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable|string',
        ]);

        // Yeni ürünü oluştur
        $newProduct = new Product();
        $newProduct->product_name = $request->input('productName');
        $newProduct->category_id = $request->input('category');
        $newProduct->price = $request->input('price');
        $newProduct->description = $request->input('description');


        // Ürünü kaydet
        $newProduct->save();
        $newInventory = new Inventory();
        $newInventory->product_id=$newProduct->product_id;
        $newInventory->stock = null;
        $newInventory->save();
        return redirect()->route('products')->with('success', 'Product added successfully');
    }
    public function viewProducts(Request $request)
    {
        $query = Product::with('image');

        // Filter by category
        if ($request->has('category')) {
            $categoryId = $request->category;

            // Check if "All Categories" is selected or category is null
            if ($categoryId != '') {
                $query->where('category_id', $categoryId);
            }
            else {

            }
        }

        // Sort by price
        if ($request->has('sort')) {
            $sortValue = $request->sort;

            if ($sortValue === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sortValue === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }
        // Debugging: Print the SQL query


        $products = $query->get();

        $fullName = session('fullName');
        $imageLink = session('imageLink');
        $pageName = 'Products';
        return view('front.products', compact('fullName', 'imageLink', 'products','pageName'));
    }
}
