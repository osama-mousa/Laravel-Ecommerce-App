@extends('layouts.default')
@section('title')
    {{ $title }}
    <hr />
@endsection
@section('content')
    {{-- we delete the H2 and used section title --}}
    {{-- <h2 class="mb-4">{{ $title }}</h2> --}}
    @include('tags._form', [
        'action' => '/tags',
        'update' => false,
    ])
@endsection
