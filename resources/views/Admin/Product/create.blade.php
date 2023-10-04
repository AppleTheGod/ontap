@extends('Admin.Layouts.adminLayout')
@section('Title', 'Create new Product')
@section('Main')
    <div class="col py-3">
        <div class="mx-auto mt-5" style="width: 50%">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="text-center">
                        Add new Product
                    </h2>
                </div>
                <div class="card-body mt-3 mb-3">
                    <form class="mx-auto" style="width: 80%" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Product name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product price</label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product quantity</label>
                            <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="category_id">
                                <option selected disabled value="0">Open this to select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product image</label>
                            <input type="file" class="form-control" name="img" value="{{ old('img') }}">
                            @error('img')
                                <span class="text-warning"><i>{{ $message }}</i></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Go back</a>
                    </form>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
@endsection
