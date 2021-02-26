<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="control-label">Tax Name<span
                class="required-star"> *</span>
        </label>

        <input id="name" type="text"
               value="{{ isset($tax) ? @$tax->name : old('name')}}"
               name="name" class="form-control" autofocus>

        @error('name')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror

    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="tax" class="control-label">Tax<span
                class="required-star"> *</span>
        </label>

        <input id="tax" type="number"
               value="{{ isset($tax) ? @$tax->tax : old('tax')}}"
               name="tax" class="form-control" autofocus>

        @error('tax')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror

    </div>
</div>

@foreach(\App\Models\Tax::TAX_TYPE as $key => $type)
    <div class="col-md-2">
        <div>
            <div class="form-group">
                <label>
                    <input name="type"
                           value="{{ @$key }}"
                           {{ isset($tax) && @$tax->type == @$key ? 'checked':old('status')}} type="radio"
                           class="i-checks">
                    {{ @$type }}
                </label>
            </div>
        </div>
    </div>
@endforeach


<div class="col-md-2">
    <div>
        <div class="form-group">
            <label>
                <input name="status"
                       {{ isset($tax) && @$tax->status ? 'checked':old('status')}} type="checkbox"
                       class="i-checks">
                Publication Status
            </label>
        </div>
    </div>
</div>
