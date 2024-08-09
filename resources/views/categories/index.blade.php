@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="my-2">Categories</h1>
            <a href="{{ route("categories.create") }}" class="btn btn-primary my-2">Add New Category</a>
        </div>
        <form method="GET" action="{{ route("categories.index") }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" placeholder="Search Categories" value="{{ request("search") }}"
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
                    @foreach ($categories as $category)
                        <tr>
                            <td class="align-middle"><strong>{{ $category->name }}</strong></td>
                            <td class="align-middle">
                                <div class="grid">
                                    <a href="{{ route("categories.show", $category) }}"
                                        class="btn btn-info btn-md mr-4">View</a>
                                    <a href="{{ route("categories.update", $category) }}"
                                        class="btn btn-warning btn-md mr-4">Edit</a>
                                    <form action="{{ route("categories.destroy", $category) }}" method="POST"
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


    </div>
@endsection
