@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="my-2">Attributes</h1>
            <a href="{{ route("attributes.create") }}" class="btn btn-primary my-2">Add New Attribute</a>
        </div>
        <form method="GET" action="{{ route("attributes.index") }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" placeholder="Search Attributes" value="{{ request("search") }}"
                    class="form-control">
                <button type="submit" class="btn btn-md btn-secondary">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attribute)
                        <tr>
                            <td class="align-middle"><strong>{{ $attribute->name }}</strong></td>
                            <td class="align-middle">
                                <div class="d-flex">
                                    <a href="{{ route("attributes.show", $attribute) }}"
                                        class="btn btn-info btn-md mr-3">View</a>
                                    <a href="{{ route("attributes.edit", $attribute) }}"
                                        class="btn btn-warning btn-md mr-3">Update</a>
                                    <form action="{{ route("attributes.destroy", $attribute) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-md">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $attributes->links() }}
        </div>
    </div>
@endsection
