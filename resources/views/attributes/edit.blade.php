@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="my-4">Edit Attribute</h1>

        <form method="POST" action="{{ route("attributes.update", $attribute->id) }}">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="name" class="form-label">Attribute Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $attribute->name }}"
                    required>
            </div>
            <button type="submit" class="btn btn-warning">Update Attribute</button>
        </form>
    </div>
@endsection
