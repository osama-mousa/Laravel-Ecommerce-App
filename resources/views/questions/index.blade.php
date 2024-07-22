@extends('layouts.default')

{{-- @section('title')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">{{ $title }}</h2>
        <a href="/tags/create" class="btn btn-outline-dark">New Question</a>
    </div>
@endsection --}}

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">{{ $title }}</h2>
        <a href="{{ route('questions.create') }}" class="btn btn-outline-dark">New Question</a>
    </div>
    @foreach ($questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a></h5>
                <div class="text-muted mb-4">
                    Asked: {{ $question->created_at->diffForHumans() }} @if ($question->user_name)
                        By: {{ $question->user_name }}
                    @endif
                </div>
                <p class="card-text">{{ Str::words($question->description, 40) }}</p>
            </div>
            @if (Auth::id() !== null && Auth::id() == $question->user_id)
                <div class="card-footer d-flex justify-content-between justify-items-center">
                    <div>
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                    </div>
                    <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                </div>
            @endif
        </div>
    @endforeach

    {{ $questions->links() }}

    <script>
        
        const showAlert = function() {

            setTimeout(function() {
                document.querySelector('.alert').style.display = "none"
            }, 1000);

            // document.querySelector('.delete-form').addEventListener('submit', function(e) {
            //     e.preventDefault();
            //     if (confirm('Are you sure you want to delete this item?')) {
            //         this.submit();
            //     }
            // })

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this item?')) {
                        this.submit();
                    }
                });
            });
        }

        showAlert();

    </script>
@endsection
