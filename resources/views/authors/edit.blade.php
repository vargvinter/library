@extends('layouts.app')

@section('content')

    <form method="post" action="{{ route('authors.update', [$author]) }}">
        {{ method_field('PUT') }}

        @include('authors._form', [
            'formHeader' => trans('strings.edit_author_form_header'),
            'submitButtonCaption' => trans('strings.general_form_confirmation_button_caption')
        ])
    </form>

@endsection
