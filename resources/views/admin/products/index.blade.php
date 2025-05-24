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
                                {{-- Search by Name or Code --}}
                                <div class="col-md-4">
                                    <label for="search" class="form-label">Search (Name or Code)</label>
                                    <input type="text" name="search" id="search" class="form-control"
                                        placeholder="Enter product name or code" value="{{ request('search') }}">
                                </div>

                                {{-- Filter by Category --}}
                                <div class="col-md-3">
                                    <label for="category_id" class="form-label">Filter By Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Filter by Brand --}}
                                <div class="col-md-3">
                                    <label for="brand_id" class="form-label">Filter By Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-select">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Submit Button --}}
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </form>


                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Products</h5>
                            <div>
                                <a href="{{ route('export.csv') }}" class="btn btn-secondary mr-2">
                                    Export CSV
                                </a>
                                <a href="{{ route('export') }}" class="btn btn-success mr-2">
                                    Export
                                </a>
                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                    Create Product
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            @if (Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::get('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Increase Stock</th>
                                        <th>Decrease Stock</th>
                                        <th>Deleted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <form action="{{ route('products.increase-stock', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="number" name="amount" min="1"
                                                        class="rounded-full w-75" required><br>
                                                    <button type="submit"
                                                        class="btn btn-success text-white mt-2 rounded-full">Increase</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.decrease-stock', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="number" name="amount" min="1"
                                                        class="rounded-full w-75" required><br>
                                                    <button type="submit"
                                                        class="btn btn-danger text-white mt-2 rounded-full">Decrease</button>
                                                </form>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-success btn-small rounded-full">{{ $product->deleted_at ? $product->deleted_at->format('Y-m-d') : 'Not Deleted' }}
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-success text-white"><i
                                                        class="material-icons">edit</i></a>

                                                <form action="{{ route('products.restore', $product->id) }}"
                                                    method="POST" class="mt-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success">Restore</button>
                                                </form>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="post" class="mt-2">
                                                    @csrf @method('DELETE')

                                                    <button type="submit" class="btn btn-danger text-white"><i
                                                            class="material-icons"
                                                            onclick="return confirm('Are you sure you want to delete this product?')">delete</i></button>
                                                </form>

                                                <form action="{{ route('products.force-delete', $product->id) }}"
                                                    method="post" class="mt-2">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white"><i
                                                            class="material-icons"
                                                            onclick="return confirm('Are you sure you want to permanently delete this product?')">forceDelete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end"><strong>Total Stock Value:</strong></td>
                                        <td><strong>${{ number_format($totalStockValue, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>Showing Results {{ $products->count() }} of
                                {{ $products->total() }} Products
                            </div>
                            <div>{{ $products->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
<div class="modal fade" id="createBtn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control mb-2">
                                <option selected disabled>-- Choose a Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                            <select name="brand_id" id="brand_id" class="form-control mb-2">
                                <option selected disabled>-- Choose a Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control mb-2" placeholder="enter name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Product Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control mb-2" placeholder="enter code"
                                value="{{ old('code') }}">
                            @error('code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price"
                                value="{{ old('price') }}" min="0" step="0.01">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity"
                                value="{{ old('quantity') }}" min="1">

                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Upload Images <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control mb-2">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Product Description <span class="text-danger">*</span></label>
                            <textarea name="description" cols="30" rows="3" id="description" class="form-control mb-2"
                                placeholder="Enter Product Description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
