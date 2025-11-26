@extends('layouts.frontend')

@section('page', 'items-create')

@section('content')
  <div class="max-w-3xl mx-auto">
      <div class="bg-white rounded-lg shadow-md">
        <div class="border-b px-6 py-4">
            <h2 class="text-xl font-bold">Create new Item</h2>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('items.store') }}">
                @include('items._form')
            </form>
        </div>
      </div>
  </div>
@endsection
