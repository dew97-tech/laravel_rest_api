<!-- resources/views/products/create.blade.php -->

@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Add New Product</h1>
        <form action="{{ route("products.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="attributes">Attributes</label>
                @foreach ($attributes as $attribute)
                    <div class="form-group">
                        <label for="attribute_{{ $attribute->id }}">{{ $attribute->name }}</label>
                        <input type="text" name="attributes[{{ $attribute->id }}]" id="attribute_{{ $attribute->id }}"
                            class="form-control">
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
