{{ csrf_field() }}

<div class="form-group">
    <label for="name">Name:</label>
    <input class="form-control" id="name" maxlength="40" name="name" placeholder="Enter author's first name" value="{{ old('name', $author->name) }}">
    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
</div>

<div class="form-group">
    <label for="surname">Surname:</label>
    <input class="form-control" id="surname" maxlength="40" name="surname" placeholder="Enter author's surname" value="{{ old('surname', $author->surname) }}">
    {!! $errors->first('surname', '<span class="text-danger">:message</span>') !!}
</div>

<div class="form-group">
    <label for="country_id">Country:</label>
    <select class="form-control" id="country_id" name="country_id">
        @foreach($countries as $country)
            <option value="{{ $country->id }}" {{ old('country_id', $author->country_id) == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('country_id', '<span class="text-danger">:message</span>') !!}
</div>

<button class="btn btn-default" type="submit">{{ $submitButtonCaption }}</button>
