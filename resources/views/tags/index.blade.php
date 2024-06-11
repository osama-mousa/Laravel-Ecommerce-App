@extends('layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">{{ $title }}</h2>
        <a href="/tags/create" class="btn btn-outline-dark">Create Tag</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    {{-- @if (session()->has('info'))
            <div class="alert alert-success">
                {{ session()->get('info') }}
            </div>
        @endif --}}

    {{-- User : {{ $user->name }} --}}
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>CREATED AT</th>
                <th>UPDATED AT</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td><a href="/tags/{{ $tag->id }}/edit">{{ $tag->name }}</a></td>
                    <td>{{ $tag->created_at }}</td>
                    <td>{{ $tag->updated_at }}</td>
                    <td>
                        <form class="delete-form" action="/tags/{{ $tag->id }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="/tags/{{ $tag->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
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
    </script>
@endsection
