@extends("layouts.app")

@section("content")
    <div class="d-flex flex-column align-items-center justify-content-end">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="my-2">Products</h1>
                <a href="{{ route("products.create") }}" class="btn btn-primary my-2">Add New Product</a>
            </div>
            <form method="GET" action="{{ route("products.index") }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" placeholder="Search Products..  Powered By Algolia"
                        value="{{ request("search") }}" class="form-control">
                    <button type="submit" class="btn btn-md btn-secondary mx-4">Search with Algolia</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Attributes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="align-middle"><strong>{{ $product->name }}</strong></td>
                                <td class="align-middle">{{ $product->category->name }}</td>
                                <td class="align-middle">
                                    @foreach ($product->attributes as $attribute)
                                        <span class=""><strong>{{ $attribute->name }} :
                                            </strong>{{ $attribute->pivot->value ?? "N/A" }}</span><br>
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                        <a href="{{ route("products.show", $product) }}"
                                            class="btn btn-info btn-md mx-2">View</a>
                                        <a href="{{ route("products.edit", $product) }}"
                                            class="btn btn-warning btn-md mx-2">Edit</a>
                                        <form action="{{ route("products.destroy", $product) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger btn-md mx-2">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <span class="align-bottom">
            {{ $products->links() }}
        </span>
    </div>
@endsection
