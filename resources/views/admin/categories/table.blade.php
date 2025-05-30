<div class="table-responsive text-nowrap">
    @include('../../layouts/alert')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Products Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @php
                $i = 1;
            @endphp
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $category->id }}">
                            Update
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $category->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                @include('./admin/categories/deleteModal')
                @include('./admin/categories/updateModal')
            @endforeach
        </tbody>
    </table>
</div>
