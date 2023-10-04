@extends('Admin.Layouts.adminLayout')
@section('Title', 'Archive')
@section('Main')
    <div class="col py-3">
        <div class="container mt-2">
            <h1 class="mb-3">Category</h1>
            <div class="d-flex float-sm justify-content-between mb-3">
                <a href="{{ route('admin.category.index') }}" class="btn btn-outline-info mt-3 mb-3">Go back</a>
                <div>
                    <form class="d-flex" action="{{ route('admin.category.search') }}" method="POST">
                        @csrf
                        <input class="form-control me-2" placeholder="Search" name="search" value="{{ old('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <table class="table">
                    <thead class="table-dark text-white">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if (count($categories) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->limit() }}</td>
                                    <td>
                                        <a onclick="return confirm('Are you sure ?')"
                                            href="{{ route('admin.category.restore', ['id' => $category->id]) }}"
                                            class="btn btn-outline-success">Restore</a>
                                        <a onclick="return confirm('Are you sure ?')"
                                            href="{{ route('admin.category.remove', ['id' => $category->id]) }}"
                                            class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $categories->onEachSide(0)->links() }}
            </div>
            @if (session('category.remove.success'))
                <div class="alert alert-success mt-5">
                    {{ session('category.remove.success') }}
                </div>
            @endif
            @if (session('category.restore.success'))
            <div class="alert alert-success mt-5">
                {{ session('category.restore.success') }}
            </div>
        @endif
        </div>
    </div>
@endsection
