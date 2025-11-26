@extends('layouts.frontend')

@section('page', 'items-edit')

@section('content')
  <div class="card max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-2">Edit Item</h2>

    <form method="POST" action="{{ route('items.update', $item) }}">
      @method('PUT')
      @include('items._form')
    </form>
  </div>
@endsection
