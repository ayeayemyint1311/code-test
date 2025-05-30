<div class="table-responsive text-nowrap">
    @include('../../layouts/alert')
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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $product->id }}">
                            Update
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $product->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                @include('./admin/products/deleteModal')
                @include('./admin/products/updateModal')
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
