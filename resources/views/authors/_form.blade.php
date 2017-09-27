{{ csrf_field() }}

<fieldset>
    <legend>{{ $formHeader }}</legend>

    <div class="form-group">
        <label for="name">{{ trans('strings.author_name_label') }}</label>
        <input name="name" value="{{ old('name', $author->name) }}" id="name" class="form-control" placeholder="{{ trans('strings.author_name_placeholder') }}">
        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="surname">{{ trans('strings.author_surname_label') }}</label>
        <input name="surname" value="{{ old('surname', $author->surname) }}" id="surname" class="form-control" placeholder="{{ trans('strings.author_surname_placeholder') }}">
        {!! $errors->first('surname', '<span class="text-danger">:message</span>') !!}
    </div>

    <div class="form-group">
        <label for="country_id">{{ trans('strings.author_country_label') }}</label>
        <select class="form-control" id="country_id" name="country_id">
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id', $author->country_id) == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('country_id', '<span class="text-danger">:message</span>') !!}
    </div>
</fieldset>

<button class="btn btn-default" type="submit">{{ $submitButtonCaption }}</button>
