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

                        @include('./admin/products/table')

                        <div class="card-footer d-flex justify-content-between">
                            <div>Showing {{ $products->count() }} of {{ $products->total() }} Products</div>
                            <div>{{ $products->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- Modal --}}
@include('./admin/products/createModal')