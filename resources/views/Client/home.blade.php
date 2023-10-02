@extends('Layouts.header')


@section('Title', 'Home')

@extends('Layouts.navbar')
@section('Content')

@if (session('denined'))
    <div class="alert alert-danger">{{session('denined')}}</div>
@endif
