@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('authors.update', [$author]) }}">
        {{ method_field('PUT') }}

        @include('authors._form', ['submitButtonCaption' => 'Edit the author'])
    </form>

@endsection
