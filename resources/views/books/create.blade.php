@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('books.store') }}">
        @include('books._form', [
            'book' => new App\Book,
            'formHeader' => trans('strings.create_book_form_header'),
            'submitButtonCaption' => trans('strings.general_form_confirmation_button_caption')
        ])
    </form>

@endsection
