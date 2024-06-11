<form action="{{ $action }}" method="post">
    @csrf
    @if ($update)
        @method('put')
    @endif
    <div class="form-group mb-3">
        <label for="name">Tag Name:</label>
        <div class="mt-3">
            <input type="text" name="name" value="{{ old('name', $tag->name) }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/tags" class="btn btn-cancel btn-secondary">Back</a>
    </div>
</form>
