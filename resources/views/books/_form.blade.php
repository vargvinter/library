{{ csrf_field() }}

<fieldset>
    <legend>{{ $formHeader }}</legend>

    <div class="form-group">
        <label for="title">{{ trans('strings.book_title_label') }}</label>
        <input class="form-control" id="title" name="title" placeholder="{{ trans('strings.book_title_placeholder') }}" value="{{ old('title', $book->title) }}">
        {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="author_id">{{ trans('strings.book_author_label') }}</label>
        <select class="form-control" id="author_id" name="author_id">
            @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                    {{ $author->surname }} {{ $author->name }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('author_id', '<span class="text-danger">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="publish_date">{{ trans('strings.book_publish_date_label') }}</label>
        <input class="form-control" id="publish_date" name="publish_date" placeholder="{{ trans('strings.book_publish_date_placeholder') }}" value="{{ old('publish_date', $book->publish_date) }}">
        {!! $errors->first('publish_date', '<span class="text-danger">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="country_id">{{ trans('strings.book_country_label') }}</label>
        <select class="form-control" id="country_id" multiple name="country_id[]">
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ in_array($country->id, old('country_id', $book->translations_list)) ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('country_id', '<span class="text-danger">:message</span>') !!}
    </div>
</fieldset>

<button class="btn btn-default" type="submit">{{ $submitButtonCaption }}</button>
