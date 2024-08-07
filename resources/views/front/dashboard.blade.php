@extends('front.layouts.main')
@section('content')
    <div style=" top: 180px; left: 350px; width:70%;">
        <div style="margin-bottom: 20px;">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Best Selling Product</h5>
                            <p class="card-text">{{ $bestSellingProduct->product->product_name }}</p>
                            <p class="card-text">Total Sold: {{ $bestSellingProduct->totalSold }}</p>



                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Best Selling Category</h5>
                            <p class="card-text">{{ $bestSellingCategory->category->category_name }}</p>
                            <p class="card-text">Total Sold: {{ $bestSellingCategory->totalSold }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Grafiği Oluşturan JavaScript Kodu -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var ordersByDate = @json($ordersByDate);

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ordersByDate.map(order => order.date),
                datasets: [{
                    label: 'Order Count',
                    data: ordersByDate.map(order => order.order_count),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
