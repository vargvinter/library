@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('books.update', [$book]) }}">
        {{ method_field('PUT') }}

        @include('books._form', ['submitButtonCaption' => 'Edit the book'])
    </form>

@endsection
