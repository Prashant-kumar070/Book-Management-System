@extends('layouts.app')

@section('content')
  <div id="app">
    <dashboard :books-count="{{ $booksCount }}" :orders-count="{{ $ordersCount }}"></dashboard>
  </div>
@endsection
