@extends('Layouts.header')
@section('Title', 'Login')
@section('Content')


    <div class="container">
        <div class="card mt-5 col-5 mx-auto shadow">
            <h5 class="card-header p-3 text-center bg-dark text-white">LOGIN</h5>
            <div class="card-body">
                <form class="p-3" method="POST" action="{{ route('loginProcess') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div class="d-flex align-item-center mt-2">
                        <p>Don't have account ?</p> &nbsp;
                        <a href="{{ route('register') }}"
                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Register
                            now</a>
                    </div>
                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="col-5 mx-auto alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="col-5 mx-auto alert alert-warning mt-3">
                {{ session('fail') }}
            </div>
        @endif
    </div>
