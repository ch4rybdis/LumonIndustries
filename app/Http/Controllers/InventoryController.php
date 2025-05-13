<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
class InventoryController extends Controller
{
    public function viewInventory(Request $request)
    {
        $query = Inventory::with('product');

        // Filtreleme: Stok sayısı 0 olanları gösterme
        if ($request->has('show_zero_stock') && $request->show_zero_stock == 'true') {
            $query->where('stock', '>', 0);
        }

        // Sıralama: Stok sayısına göre
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('stock', $request->sort);
        }

        $inventories = $query->get();

        $fullName = session('fullName');
        $imageLink = session('imageLink');
        $pageName = 'Inventory';
        return view('front.inventory', compact('fullName', 'imageLink', 'inventories','pageName'));
    }

    public function updateStock($id, Request $request)
{
    // $id parametresi, hangi ürünün stokunu güncellediğinizi belirtir
    $newStock = intval($request->input('new_stock'));

// Stok güncelleme işlemini gerçekleştirin, örneğin:
$product = Product::where('product_id', $id)->first();

if ($product) {
    // Eğer inventory modeli içinde stok bilgisi varsa ona erişelim
    $currentStock = $product->inventory->stock; // Mevcut stok miktarını al
    $newStock = $currentStock + $newStock; // Yeni stok miktarını hesapla
    $product->inventory->update(['stock' => $newStock]); // Stok güncellemesini yap
}

    return redirect()->route('inventory')->with('success', 'Stock updated successfully');
}

public function deleteStock($id, Request $request)
{
    // $id parametresi, hangi ürünün stokunu güncellediğinizi belirtir
    $newStock = intval($request->input('new_stock'));

// Stok güncelleme işlemini gerçekleştirin, örneğin:
$product = Product::where('product_id', $id)->first();

if ($product) {
    // Eğer inventory modeli içinde stok bilgisi varsa ona erişelim
    $currentStock = $product->inventory->stock; // Mevcut stok miktarını al
    $newStock = $currentStock - $newStock; // Yeni stok miktarını hesapla
    $product->inventory->update(['stock' => $newStock]); // Stok güncellemesini yap
}

    return redirect()->route('inventory')->with('success', 'Stock updated successfully');
}
}
