@extends('layouts.frontend')

@section('page', 'items-create')

@section('content')
  <div class="card max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-2">Create new Item</h2>

    <form method="POST" action="{{ route('items.store') }}">
      @include('items._form')
    </form>
  </div>
@endsection
