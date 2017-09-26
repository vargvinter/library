@extends('layouts.app')

@section('content')

    <div class="text-right">
        <a class="btn btn-success" href="{{ route('authors.create') }}">Add an author</a>
    </div>

    <hr>

    @if($authors->count())
        <table class="table">
            <tr>
                <th>Author</th>
                <th>Country</th>
                <th class="fit">&nbsp;</th>
            </tr>

            @foreach($authors as $author)
                <tr>
                    <td>{{ $author->present()->fullName }}</td>
                    <td>{{ $author->country->name }}</td>
                    <td><a href="{{ route('authors.edit', [$author->id]) }}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                </tr>
            @endforeach

        </table>
    @else

        @include('_partials.no_records', [
            'message' => 'No authors found.'
        ])

    @endif

@endsection
