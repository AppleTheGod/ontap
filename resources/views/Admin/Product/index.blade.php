@extends('Admin.Layouts.adminLayout')
@section('Title', 'Product')
@section('Main')
    <div class="col py-3">
        <div class="container mt-2">
            <h1 class="mb-3">Products</h1>
            <div class="d-flex float-sm justify-content-between">
                <div class="d-flex">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-outline-success m-3">Create new</a>
                    <a href="{{ route('admin.product.archive') }}" class="btn btn-outline-dark m-3">Archive</a>
                    @if (session('product.create.success'))
                        <div class="alert alert-success m-1">
                            {{ session('product.create.success') }}
                        </div>
                    @endif
                    @if (session('product.update.success'))
                        <div class="alert alert-success m-1">
                            {{ session('product.update.success') }}
                        </div>
                    @endif
                    @if (session('product.destroy.success'))
                        <div class="alert alert-success m-1">
                            {{ session('product.destroy.success') }}
                        </div>
                    @endif
                </div>

                <div>
                    <form class="d-flex" action="{{ route('admin.product.search') }}" method="POST">
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
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if (count($products) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->getCategoryProductName() }}</td>
                                    <td>{{ $product->limit() }}</td>
                                    <td><img class="rounded shadow-sm"
                                            src="{{ asset('storage/' . $product->img) ?? $product->img }}" alt=""
                                            width="150px" height="150px"></td>

                                    <td>
                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                            class="btn btn-outline-info mb-1">Edit</a>
                                        <a onclick="return confirm('Are you sure ?')"
                                            href="{{ route('admin.product.destroy', ['id' => $product->id]) }}"
                                            class="btn btn-outline-danger">Trash</a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->onEachSide(0)->links() }}
            </div>

        </div>
    </div>
@endsection
