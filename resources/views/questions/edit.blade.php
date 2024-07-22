@extends('layouts.default')

@section('title')
    {{ $title }}
    <hr />
@endsection

@section('content')

    <form action="{{ route('questions.update', $question->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title', $question->title) }}">
            @error('title')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" rows="6"
                name="description">{{ old('description', $question->description) }}</textarea>
            @error('description')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update Question</button>
            <a href="{{ route('questions.index') }}" class="btn btn-cancel btn-secondary">Back</a>
        </div>
    </form>

@endsection
