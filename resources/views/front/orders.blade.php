@extends('front.layouts.main')
@section('content')
    <div style=" top: 200px; left: 300px; width:75%;">
        <!-- Orders Tablosu -->
        <!-- Orders Filtreleme ve Sıralama Formu -->
        <!-- Orders Filtreleme ve Sıralama Formu -->
        <form action="{{ route('orders') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="status" class="form-label">Filter by Status:</label>
                    <select name="status" id="status" class="form-select custom-select"
                        style="font-size: 14px; padding: 6px;">
                        <option value="">All</option>
                        <option value="awaiting">Awaiting</option>
                        <option value="accepted">Accepted</option>
                        <option value="shipped">Shipped</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div class="col-md-4 mb-2">
                    <label for="sort" class="form-label">Sort by Date:</label>
                    <select name="sort" id="sort" class="form-select custom-select"
                        style="font-size: 14px; padding: 6px;">
                        <option value="desc">Newest First</option>
                        <option value="asc">Oldest First</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                </div>
            </div>
        </form>



        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Address</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Order Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->order_id }}</th>
                        <td>{{ $order->product->product_name }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->order_status }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
