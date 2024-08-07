<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function viewOrders(Request $request){
        $query = Order::with(['product']);

    // Filtreleme: Status
    if ($request->has('status')) {

        $status = $request->status;


            // Check if "All Categories" is selected or category is null
            if ($status != '' && $status !== null) {
                $query->where('order_status', $status);
            }
            else {

            }

    }

    // Sıralama: Tarih
    if ($request->has('sort')) {

       $sort = $request->sort;


            // Check if "All Categories" is selected or category is null
            if ($sort =='desc') {
                $query->orderBy('order_date', 'desc');
            }
            else {
                $query->orderBy('order_date', 'asc');
            }

    }
    // Varsayılan sıralama, en yeni tarihten en eskiye doğru

    // Debugging: Print the SQL query
    // dd($query->toSql());

    $orders = $query->get();
    $fullName = session('fullName');
    $imageLink = session('imageLink');
    $pageName = 'Orders';
    return view('front.orders', compact('fullName', 'imageLink', 'orders','pageName'));
    }
}
