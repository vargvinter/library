@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('books.update', [$book]) }}">
        {{ method_field('PUT') }}

        @include('books._form', [
            'formHeader' => trans('strings.edit_book_form_header'),
            'submitButtonCaption' => trans('strings.general_form_confirmation_button_caption')
        ])
    </form>

@endsection
