@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('authors.store') }}">
        @include('authors._form', [
            'author' => new App\Author,
            'submitButtonCaption' => 'Create the author'
        ])
    </form>

@endsection
