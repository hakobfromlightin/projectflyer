@inject('countries', 'App\Http\Utilities\Country')

<div class="from-group">
    <label for="street">Street:</label>
    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}">
</div>

<div class="from-group">
    <label for="city">City:</label>
    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
</div>

<div class="from-group">
    <label for="zip">Zip/Postal Code:</label>
    <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}">
</div>

<div class="from-group">
    <label for="country">Country:</label>
    <select name="country" id="country" class="form-control">
        @foreach($countries::all() as $country => $code)
            <option value="{{ $code }}">{{ $country }}</option>
        @endforeach
    </select>
</div>

<div class="from-group">
    <label for="state">State:</label>
    <select name="state" id="state" class="form-control">

    </select>
</div>

<hr>

<div class="from-group">
    <label for="price">Sale Price:</label>
    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
</div>

<div class="from-group">
    <label for="description">Zip/Postal Code:</label>
            <textarea type="text" name="description" id="description" class="form-control" rows="10">
                {{ old('description') }}
            </textarea>
</div>

<div class="from-group">
    <label for="photos">Photos:</label>
    <input type="file" name="photos" id="photos" class="form-control" value="{{ old('photos') }}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Create Flyer</button>
</div>