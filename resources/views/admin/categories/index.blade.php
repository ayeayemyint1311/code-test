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
                            Categories List ( Master Data )
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#createBtn">
                                Create Category
                            </button>
                        </h5>
                       <div class="card-body">
                            @include('./admin/categories/table')
                       </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>Showing Results {{ $categories->count() }} of
                                {{ $categories->total() }} Categories
                            </div>
                            <div>{{ $categories->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Modal -->
@include('./admin/categories/createModal')
