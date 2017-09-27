@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('authors.store') }}">
        @include('authors._form', [
            'author' => new App\Author,
            'formHeader' => trans('strings.create_author_form_header'),
            'submitButtonCaption' => trans('strings.general_form_confirmation_button_caption')
        ])
    </form>

@endsection
