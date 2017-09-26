{{ csrf_field() }}

<div class="form-group">
    <label for="name">Name:</label>
    <input name="name" value="{{ old('name', $author->name) }}" id="name" class="form-control" autocomplete=""placeholder="Enter author's first name">
</div>

<div class="form-group">
    <label for="surname">Surname:</label>
    <input name="surname" value="{{ old('surname', $author->surname) }}" id="surname" class="form-control" placeholder="Enter author's surname">
</div>

<div class="form-group">
    <label for="country_id">Country:</label>
    <select name="country_id" id="country_id" class="form-control">
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ old('country_id', $author->country_id) == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-default">{{ $submitButtonCaption }}</button>
