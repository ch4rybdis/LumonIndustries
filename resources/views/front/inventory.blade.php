@extends('front.layouts.main')
@section('content')
    <div style=" top: 180px; left: 300px; width:80%;">
        <!-- Inventories Tablosu -->
        <div style="top: 180px; left: 300px; width:80%;">
            <!-- Filtreleme ve Sıralama Formu -->
            <form action="{{ route('inventory') }}" method="GET">
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="show_zero_stock" id="show_zero_stock"
                            value="true" {{ request('show_zero_stock') == 'true' ? 'checked' : '' }}>
                        <label class="form-check-label" for="show_zero_stock">Don't Show Zero Stock</label>
                    </div>

                    <div class="mb-3">
                        <label for="sort" class="form-label">Sort by Stock:</label>
                        <select name="sort" id="sort" class="form-select custom-select">
                            <option value="">Default Sorting</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>

                    <button style="height: 50px" type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Update Stock</th> <!-- Yeni eklenen sütun -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <th scope="row">{{ $inventory->product->product_id }}</th>
                            <td>{{ $inventory->product->product_name }}</td>
                            <td>{{ $inventory->stock }}</td>
                            <td>
                                <form action="{{ route('updateStock', ['id' => $inventory->product->product_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="number" name="new_stock" class="form-control"
                                            placeholder="Üretilen Adet">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('deleteStock', ['id' => $inventory->product->product_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group">
                                        <input type="number" name="new_stock" class="form-control"
                                            placeholder="Satılan Adet">
                                        <button type="submit" class="btn btn-danger">Satıldı</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
