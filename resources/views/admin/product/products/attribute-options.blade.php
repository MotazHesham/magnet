@foreach($attributes as $attribute)
    <div class="form-group row">
        <div class="col-md-3">
            <input type="hidden" name="attribute_options[]" value="{{ $attribute->id }}">
            <input type="text" class="form-control" name="choice[]" value="{{ $attribute->name }}" readonly>
        </div>
        <div class="col-md-8">
            <select class="form-control select2-ajax attribute_choice" name="attribute_options_{{ $attribute->id }}[]" onchange="update_sku()"  multiple>
                @foreach ($attribute->attributeAttributeValues as $attributeValue)
                    <option value="{{ $attributeValue->id }}">
                        {{ $attributeValue->value }}
                    </option>
                @endforeach
            </select> 
        </div>
    </div>
@endforeach