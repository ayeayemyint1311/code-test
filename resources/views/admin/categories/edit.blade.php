<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <h5 class="card-header">
                            Edit Category
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary float-end">
                                Back
                            </a>
                        </h5>
                        <form action="{{ route('categories.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Category Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control mb-3"
                                            value="{{ old('name', $category->name)}}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
