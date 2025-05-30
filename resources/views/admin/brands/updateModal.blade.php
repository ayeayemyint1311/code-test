<!-- Update Modal -->
<div class="modal fade" id="updateModal{{ $brand->id }}" tabindex="-1"
    aria-labelledby="updateModalLabel{{ $brand->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $brand->id }}">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $brand->name) }}">
                            @error('name')
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
