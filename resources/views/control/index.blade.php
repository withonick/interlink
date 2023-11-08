@extends('layouts.admin')

@section('title', 'Index Page')

@section('content')

    <h1>Hello world</h1>

    {{ strtoupper(Auth::user()->getRoleNames()) }}

@endsection
