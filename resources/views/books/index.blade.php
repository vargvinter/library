@inject('filter', 'App\Filters\BooksFilter')

@extends('layouts.app')

@section('content')

    <div class="text-right">
        <a class="btn btn-success" href="{{ route('books.create') }}">Add a book</a>
    </div>

    <hr>

    <form action="{{ route('books.index') }}" class="form-inline">
        <div class="form-group">
            <input class="form-control" name="title" placeholder="Filter by a title" type="text" value="{{ request('title') }}">
        </div>

        <div class="form-group">
            <input class="form-control" name="author" placeholder="Filter by an author" type="text" value="{{ request('author') }}">
        </div>

        <div class="form-group">
            <input class="form-control" name="translation" placeholder="Filter by a translation" type="text" value="{{ request('translation') }}">
        </div>

        <button class="btn btn-default" type="submit">Filter</button>
        &nbsp;
        <a class="" href="{{ route('books.index') }}">Reset</a>
    </form>

    <hr>

    @if($books->count())

        <table class="table">
            <tr>
                <th>{{ $filter->sortByLink('title', 'Title', 'books.index') }}</th>
                <th>Author</th>
                <th>{{ $filter->sortByLink('publish_date', 'Publish date', 'books.index') }}</th>
                <th>Translations</th>
                <th class="fit">&nbsp;</th>
            </tr>

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title}}</td>
                    <td>{{ $book->author->present()->fullName }}</td>
                    <td>{{ $book->publish_date }}</td>
                    <td>{{ $book->present()->translations }}</td>
                    <td><a href="{{ route('books.edit', [$book->id]) }}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                </tr>
            @endforeach

        </table>

        {{ $books->links() }}
    @else

        @include('_partials.no_records', [
            'message' => 'No books found.'
        ])

    @endif

@endsection
