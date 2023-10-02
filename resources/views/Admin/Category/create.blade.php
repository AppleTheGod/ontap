@extends('Admin.Layouts.adminLayout')
@section('Title', 'Create new Category')
@section('Main')
    <div class="col py-3">
        <div class="mx-auto mt-5" style="width: 50%">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="text-center">
                        Add new Category
                    </h2>
                </div>
                <div class="card-body mt-3 mb-3">
                    <form class="mx-auto" style="width: 80%" action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Go back</a>
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
