@extends('layouts.default')

@section('title')
    {{ $title }}
    <hr />
@endsection

@section('content')
    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">{{ $title }}</h2>
    </div> --}}
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $question->title }}</h5>
            <div class="text-muted mb-4">
                Asked: {{ $question->created_at->diffForHumans() }} @if ($question->user_name)
                    By: {{ $question->user_name }}
                @endif
            </div>
            <p class="card-text">{{ $question->description }}</p>
        </div>
    </div>
    <div class="form-group d-flex justify-content-between">
        {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
        <a href="/questions" class="btn btn-cancel btn-secondary">Back</a>
    </div>
@endsection
