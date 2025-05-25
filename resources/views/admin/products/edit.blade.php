<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <h5 class="card-header">
                            Edit Product
                            <a href="{{ route('products.index') }}" class="btn btn-secondary float-end">
                                Back
                            </a>
                        </h5>
                        <form action="{{ route('products.update', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Category Name <span
                                                class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control mb-2">
                                            <option selected disabled>-- Choose a Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
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
                                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
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
                                        <label class="form-label">Product Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control mb-2"
                                            placeholder="enter name" value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Product Code <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="code" class="form-control mb-2"
                                            placeholder="enter code" value="{{ old('code', $product->code) }}">
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control"
                                            placeholder="Enter price" value="{{ old('price', $product->price) }}" min="0"
                                            step="0.01">
                                        @error('price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                        <input type="number" name="quantity" class="form-control"
                                            placeholder="Enter quantity" value="{{ old('quantity', $product->quantity) }}" min="1">

                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Upload Images <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control mb-2">
                                        {{-- @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-2">
                                        <label class="form-label">Product Description <span
                                                class="text-danger">*</span></label>
                                        <textarea name="description" cols="30" rows="3" id="description" class="form-control mb-2"
                                            placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
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
        </div>
    </div>
</x-app-layout>
