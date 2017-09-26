@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('books.store') }}">
        @include('books._form', [
            'book' => new App\Book,
            'submitButtonCaption' => 'Create the book'
        ])
    </form>

@endsection
