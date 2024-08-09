@extends("layouts.app")

@section("content")
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 900px;">
            <h1 class="my-4 text-center">Edit Product</h1>
            <form method="POST" action="{{ route("products.update", $product) }}">
                @csrf
                @method("PUT")
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old("name", $product->name) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old("category_id", $product->category_id) ? "selected" : "" }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="attributes" class="form-label">Attributes</label>
                    @foreach ($attributes as $attribute)
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ $attribute->name }}</span>
                            </div>
                            <input type="text" name="attributes[{{ $attribute->id }}]" class="form-control"
                                value="{{ old("attributes." . $attribute->id, $product->attributes->where("id", $attribute->id)->first()->pivot->value ?? "") }}">
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update Product</button>
                    <a href="{{ route("products.index") }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
