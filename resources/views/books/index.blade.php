@inject('filter', 'App\Filters\BooksFilter')

@extends('layouts.app')

@section('content')

    <div class="text-right">
        <a class="btn btn-success" href="{{ route('books.create') }}">{{ trans('strings.add_book_button_caption') }}</a>
    </div>

    <hr>

    <form action="{{ route('books.index') }}" class="form-inline">
        <div class="form-group">
            <input class="form-control" name="title" placeholder="{{ trans('strings.filter_by_title_placeholder') }}" type="text" value="{{ request('title') }}">
        </div>

        <div class="form-group">
            <input class="form-control" name="author" placeholder="{{ trans('strings.filter_by_author_placeholder') }}" type="text" value="{{ request('author') }}">
        </div>

        <div class="form-group">
            <input class="form-control" name="translation" placeholder="{{ trans('strings.filter_by_translation_placeholder') }}" type="text" value="{{ request('translation') }}">
        </div>

        <button class="btn btn-default" type="submit">{{ trans('strings.filter_button_caption') }}</button>
        &nbsp;
        <a class="" href="{{ route('books.index') }}">{{ trans('strings.reset_button_caption') }}</a>
    </form>

    <hr>

    @if($books->count())

        <table class="table">
            <tr>
                <th>{{ $filter->url('books.index', 'title', trans('strings.title_listing_table_header')) }}</th>
                <th>{{ trans('strings.author_listing_table_header') }}</th>
                <th class="fit">{{ $filter->url('books.index', 'publish_date', trans('strings.publish_date_listing_table_header')) }}</th>
                <th>{{ trans('strings.translations_listing_table_header') }}</th>
                <th class="fit">&nbsp;</th>
            </tr>

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title}}</td>
                    <td class="fit">{{ $book->author->present()->fullName }}</td>
                    <td>{{ $book->publish_date }}</td>
                    <td>{{ $book->present()->translations }}</td>
                    <td><a href="{{ route('books.edit', [$book->id]) }}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                </tr>
            @endforeach

        </table>

        {{ $books->appends(Request::except('page'))->links() }}
    @else

        @include('_partials.no_records', [
            'message' => trans('strings.no_books_found_message')
        ])

    @endif

@endsection
