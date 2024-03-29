@inject('countries', 'App\Http\Utilities\Country')
<div class="row">
    <div class="col-md-6">
        {{ csrf_field() }}

        <div class="from-group">
            <label for="street">Street:</label>
            <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
        </div>

        <div class="from-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
        </div>

        <div class="from-group">
            <label for="zip">Zip/Postal Code:</label>
            <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}" required>
        </div>

        <div class="from-group">
            <label for="country">Country:</label>
            <select name="country" id="country" class="form-control" required>
                @foreach($countries::all() as $country => $code)
                    <option value="{{ $code }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="from-group">
            <label for="state">State:</label>
            <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="from-group">
            <label for="price">Sale Price:</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="from-group">
            <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="10">
                    {{ old('description') }}
                </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Flyer</button>
        </div>
    </div>
</div>