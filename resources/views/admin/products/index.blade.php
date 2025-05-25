<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <form method="GET" action="{{ route('products.index') }}" class="m-4">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label for="search" class="form-label">Search (Name or Code)</label>
                                    <input type="text" name="search" id="search" class="form-control"
                                           placeholder="Enter product name or code" value="{{ request('search') }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="category_id" class="form-label">Filter By Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="brand_id" class="form-label">Filter By Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-select">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Products</h5>
                            <div>
                                <a href="{{ route('export.csv') }}" class="btn btn-secondary me-2">Export CSV</a>
                                <a href="{{ route('export') }}" class="btn btn-success me-2">Export</a>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                                    Create Product
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive text-nowrap">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>+ Stock</th>
                                        <th>- Stock</th>
                                        <th>Deleted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $i => $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <form action="{{ route('products.increase-stock', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="number" name="amount" min="1" class="form-control mb-1" required>
                                                    <button type="submit" class="btn btn-success btn-sm">Increase</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.decrease-stock', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="number" name="amount" min="1" class="form-control mb-1" required>
                                                    <button type="submit" class="btn btn-danger btn-sm">Decrease</button>
                                                </form>
                                            </td>
                                            <td>
                                                {{ $product->deleted_at ? $product->deleted_at->format('Y-m-d') : 'Not Deleted' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success btn-sm mb-1">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline-block mb-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                                </form>

                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block mb-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('products.force-delete', $product->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Permanently delete this product?')">
                                                        <i class="material-icons">delete_forever</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end"><strong>Total Stock Value:</strong></td>
                                        <td colspan="6"><strong>${{ number_format($totalStockValue, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <div>Showing {{ $products->count() }} of {{ $products->total() }} Products</div>
                            <div>{{ $products->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Product Modal --}}
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control">
                                <option disabled selected>-- Choose Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        {{-- Brand --}}
                        <div class="mb-3">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <select name="brand_id" class="form-control">
                                <option disabled selected>-- Choose Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        {{-- Name, Code, Price, Quantity, etc. --}}
                        <div class="mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                            @error('code') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" value="{{ old('price') }}">
                            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" min="1" value="{{ old('quantity') }}">
                            @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control">
                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
