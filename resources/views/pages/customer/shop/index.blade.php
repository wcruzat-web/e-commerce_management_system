{{--
    ERP MODULE: Customer — Shop
    DESCRIPTION: Product listing page (dummy). Placeholder until backend is built.
    TODO (Backend): Replace with live product catalog from database.
--}}
@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
    <h1 class="text-2xl font-bold text-gray-900">Shop</h1>
    <p class="text-gray-400 mt-2">Product catalog coming soon.</p>
    <a href="{{ route('tracking') }}" class="inline-block mt-6 text-sm font-medium text-cyan-500 hover:text-cyan-600">&larr; Back to Tracking</a>
</div>

@endsection
