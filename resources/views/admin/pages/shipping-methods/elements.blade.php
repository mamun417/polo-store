<div class="col-md-12">
    <div class="form-group">
        <label id="title" class="control-label">Title<span class="required-star"> *</span></label>
        <input id="title" type="text"
               name="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ isset($shippingMethod) ? @$shippingMethod->title : old('title') }}"
        >
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ @$message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label id="applicable_amount" class="control-label">Applicable Amount<span class="required-star"> *</span></label>
        <input id="applicable_amount" type="text"
               name="applicable_amount"
               class="form-control @error('applicable_amount') is-invalid @enderror"
               value="{{ isset($shippingMethod) ? @$shippingMethod->applicable_amount : old('applicable_amount') }}"
        >
        @error('applicable_amount')
        <span class="invalid-feedback" role="alert">
            <strong>{{ @$message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label id="charge" class="control-label">Charge<span class="required-star"> *</span></label>
        <input id="charge" type="text"
               name="charge"
               class="form-control @error('charge') is-invalid @enderror"
               value="{{ isset($shippingMethod) ? @$shippingMethod->charge : 0 }}"
        >
        @error('charge')
        <span class="invalid-feedback" role="alert">
            <strong>{{ @$message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label class="">
            <div class="icheckbox_square-green" style="position: relative;">
                <input type="checkbox" name="status"
                       class="i-checks @error('status') is-invalid @enderror"
                       style="position: absolute; opacity: 0;"
                    {{ isset($shippingMethod) && @$shippingMethod->status ? 'checked' : old('status') }}
                >
                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
            </div>
            Publication Status
        </label>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ @$message }}</strong>
        </span>
        @enderror
    </div>
</div>
