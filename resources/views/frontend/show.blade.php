@extends('layouts.frontend')

@section('page', 'show')

@section('content')
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-semibold mb-2">Item details</h1>
    <p class="text-gray-600 mb-4">This page fetches the item data via the API and displays it.</p>

    <div id="app" data-id="{{ $id }}"></div>
  </div>
@endsection
