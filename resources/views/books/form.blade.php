{{ csrf_field() }}

<div class="form-group">
    <label for="title">Title:</label>
    <input name="title" value="{{ old('title', $book->title) }}" id="title" class="form-control" autocomplete=""placeholder="Enter book's title">
</div>

<div class="form-group">
    <label for="author_id">Author:</label>
    <select name="author_id" id="author_id" class="form-control">
        @foreach($authors as $author)
            <option value="{{ $author->id }}" {{ old('author_id', $author->author_id) == $author->id ? 'selected' : '' }}>
                {{ $author->surname }} {{ $author->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="publish_date">Publish date:</label>
    <input name="publish_date" value="{{ old('publish_date', $book->publish_date) }}" id="publish_date" class="form-control" autocomplete=""placeholder="Enter book's publish date">
</div>

<div class="form-group">
    <label for="country_id">Country:</label>
    <select name="country_id[]" id="country_id" class="form-control" multiple>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ in_array($country->id, old('country_id', $book->translations_list)) ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-default">{{ $submitButtonCaption }}</button>
