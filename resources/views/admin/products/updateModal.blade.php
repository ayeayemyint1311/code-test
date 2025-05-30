<!-- Update Modal -->
<div class="modal fade" id="updateModal{{ $product->id }}" tabindex="-1"
    aria-labelledby="updateModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
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
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control mb-2" placeholder="enter name"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Product Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control mb-2" placeholder="enter code"
                                value="{{ old('code', $product->code) }}">
                            @error('code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price"
                                value="{{ old('price', $product->price) }}" min="0" step="0.01">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity"
                                value="{{ old('quantity', $product->quantity) }}" min="1">

                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Upload Images <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control mb-2">
                            {{-- @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <label class="form-label">Product Description <span class="text-danger">*</span></label>
                            <textarea name="description" cols="30" rows="3" id="description" class="form-control mb-2"
                                placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
