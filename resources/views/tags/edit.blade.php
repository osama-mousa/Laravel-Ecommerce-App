@extends('layouts.default')
@section('title')
    {{ $title }}
    <hr />
@endsection
@section('content')
    @include('tags._form', [
        'action' => '/tags/' . $tag->id,
        'update' => true,
    ])
@endsection
