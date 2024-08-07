@extends('front.layouts.main')
@section('content')
    <div style=" width:80%">
        <div class="container">
            <!-- Filtreleme ve Sıralama Navbarı -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <!-- Filtreleme Seçenekleri -->
                    <form action="{{ route('products') }}" method="GET">
                        <label for="category" class="form-label">Filter by Category:</label>
                        <select name="category" id="category" class="form-select custom-select"
                            style="font-size: 14px; padding: 6px; width: 50%;">
                            <option value="">All Categories</option>
                            <option value="1">Tech</option>
                            <option value="2">Painting</option>
                            <option value="3">Coffee</option>
                            <option value="4">Home</option>
                            <option value="5">Book</option>
                            <!-- Add more categories as needed -->
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Add Product Butonu -->


                    <!-- Sıralama Seçenekleri -->
                    <form action="{{ route('products') }}" method="GET">
                        <label for="sort" class="form-label">Sort by Price:</label>
                        <select name="sort" id="sort" class="form-select custom-select"
                            style="font-size: 14px; padding: 6px; width: 50%;">
                            <option value="">Default Sorting</option>
                            <option value="price_asc">Price - Low to High</option>
                            <option value="price_desc">Price - High to Low</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                    </form>

                    @if (session('department_id') == 8)
                        <button style=" float: right;" type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                            Add Product
                        </button>
                    @endif
                </div>
            </div>


            @if (session('department_id') == 5)
                <!-- Ürün Kartları -->
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $product->product_id }}">
                                @if ($product->image && $product->image->image_link)
                                    <img src="{{ $product->image->image_link }}" alt="{{ $product->product_name }}">
                                @else
                                    <img src="https://w7.pngwing.com/pngs/621/380/png-transparent-camera-images-photo-picture-set-app-incredibles-icon.png"
                                        alt="{{ $product->product_name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->product_name }}</h5>
                                    <p class="card-text">${{ $product->price }}</p>
                                    <!-- İsterseniz diğer ürün bilgilerini ekleyebilirsiniz -->
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="editProductModal{{ $product->product_id }}" tabindex="-1"
                            aria-labelledby="editProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel">Edit Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Düzenleme Formu -->
                                        <form action="{{ route('updateImage', ['id' => $product->product_id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Product
                                                    Name:{{ $product->product_name }} </label>

                                            </div>
                                            <div class="mb-3">
                                                <label for="image_link" class="form-label">Product
                                                    Image Link:</label>
                                                <input type="text" class="form-control" id="image_link" name="image_link"
                                                    value="{{ optional($product->image)->image_link }}" required>

                                            </div>

                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if (session('department_id') == 8 || session('department_id') == 1)
                <!-- Ürün Kartları -->
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $product->product_id }}">
                                @if ($product->image && $product->image->image_link)
                                    <img src="{{ $product->image->image_link }}" style="max-width: 100%; max-height:100%"
                                        alt="{{ $product->product_name }}">
                                @else
                                    <img src="https://w7.pngwing.com/pngs/621/380/png-transparent-camera-images-photo-picture-set-app-incredibles-icon.png"
                                        alt="{{ $product->product_name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->product_name }}</h5>
                                    <p class="card-text">${{ $product->price }}</p>
                                    <!-- İsterseniz diğer ürün bilgilerini ekleyebilirsiniz -->
                                </div>
                            </div>
                        </div>
                        @if (session('department_id') == 8)
                            <!-- Düzenleme Modalı -->
                            <div class="modal fade" id="editProductModal{{ $product->product_id }}" tabindex="-1"
                                aria-labelledby="editProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Düzenleme Formu -->
                                            <form action="{{ route('editProduct', ['id' => $product->product_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="productName" class="form-label">Product Name:</label>
                                                    <input type="text" class="form-control" id="productName"
                                                        name="productName" value="{{ $product->product_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Price:</label>
                                                    <input type="number" class="form-control" id="price"
                                                        name="price" value="{{ $product->price }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description:</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>

                                            <form action="{{ route('deleteProduct', ['id' => $product->product_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button style="margin:10px" type="submit"
                                                    class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>



                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif


            @if (session('department_id') == 8)
                <!-- Ürün Ekleme Modalı -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Ürün Ekleme Formu -->
                                <form action="{{ route('addProduct') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="productName" class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" id="productName" name="productName"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category:</label>
                                        <select name="category" id="category" class="form-select custom-select"
                                            required>
                                            <option value="1">Tech</option>
                                            <option value="2">Painting</option>
                                            <option value="3">Coffee</option>
                                            <option value="4">Home</option>
                                            <option value="5">Book</option>
                                            <!-- Add more categories as needed -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price:</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
