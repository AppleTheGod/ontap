@extends('Layouts.header')

@section('Title', 'Register')


@section('Content')
    <div class="container">
        <div class="card mt-5 col-5 mx-auto shadow">
            <h5 class="card-header p-3 text-center bg-dark text-white">REGISTER</h5>
            <div class="card-body">
                <form class="p-3" method="POST" action="{{ route('registerProcess') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="fst-italic text-warning">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="fst-italic text-warning">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                        @error('password')
                            <span class="fst-italic text-warning">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="d-flex align-item-center mt-2">
                        <p>Already have account ?</p> &nbsp;
                        <a href="{{ route('login') }}"
                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Login
                            now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
