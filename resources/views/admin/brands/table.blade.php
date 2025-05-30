<div class="table-responsive text-nowrap">
    @include('../../layouts/alert')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand Name</th>
                <th>Products Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @php
                $i = 1;
            @endphp
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->products_count }}</td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $brand->id }}">
                            Update
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $brand->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                 @include('./admin/brands/deleteModal')
                @include('./admin/brands/updateModal')
            @endforeach
        </tbody>
    </table>
</div>
