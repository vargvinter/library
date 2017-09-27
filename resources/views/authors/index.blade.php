@extends('layouts.app')

@section('content')

    <div class="text-right">
        <a class="btn btn-success" href="{{ route('authors.create') }}">{{ trans('strings.add_author_button_caption') }}</a>
    </div>

    <hr>

    @if($authors->count())
        <table class="table">
            <tr>
                <th>{{ trans('strings.author_listing_table_header') }}</th>
                <th>{{ trans('strings.country_listing_table_header') }}</th>
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

        {{ $authors->links() }}
    @else

        @include('_partials.no_records', [
            'message' => trans('strings.no_authors_found_message')
        ])

    @endif

@endsection
