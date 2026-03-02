@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    Home
@endsection

@section('page-title', 'Welcome')

@section('content')

    <p>Welcome, <strong>{{ Auth::user()->name ?? 'Guest' }}</strong>!</p>
    <p>You are now logged in to the Admin Panel.</p>

@endsection