@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="my-4">Add New Attribute</h1>

        <form method="POST" action="{{ route("attributes.store") }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Attribute Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Attribute</button>
        </form>
    </div>
@endsection
