@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_at" class="control-label">Start At<span class="required-star"> *</span></label>
                <input id="start_at"
                       name="start_at" class="form-control date"
                       value="{{ isset($offer) ? @$offer->start_at : old('start_at')}}" required>

                @error('start_at')
                <span class="help-block m-b-none text-danger">
                    {{ @$message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="expire_at" class="control-label">Expire At<span class="required-star"> *</span></label>
                <input id="expire_at" type="text"
                       name="expire_at" class="form-control date"
                       value="{{ isset($offer) ? @$offer->expire_at : old('expire_at')}}"
                       required>

                @error('expire_at')
                <span class="help-block m-b-none text-danger">
                    {{ @$message }}
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="product_id" class="control-label">Product<span class="required-star"> *</span></label>
        <select class="form-control"
                {{ isset($offer) ? 'disabled' : '' }}
                name="product_id">

            @php($product = isset($offer) ? $offer->product : $product)

            @isset($product))
            <option value="{{ $product->id }}">
                {{ $product->name }}
            </option>
            @endisset

        </select>

        @error('product_id')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input id="title" type="text" value="{{ isset($offer) ? @$offer->title : old('title')}}"
               name="title" class="form-control">

        @error('title')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="amount" class="control-label">Amount<span class="required-star"> *</span></label>
        <input id="amount" type="number" value="{{ isset($offer) ? @$offer->amount : old('amount')}}"
               name="amount" class="form-control" step="0.01" required>

        @error('amount')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>

@foreach(\App\Models\Offer::OFFER_TYPE as $key => $type)
    <div class="col-md-2">
        <div>
            <div class="form-group">
                <label>
                    <input name="type"
                           value="{{ @$key }}"
                           {{ isset($offer) && @$offer->type == @$key ? 'checked':old('type')}} type="radio"
                           class="i-checks" required>
                    {{ @$type }}
                </label>
            </div>
        </div>
    </div>
@endforeach

@error('amount')
<div class="col-md-12">
    <div class="form-group">
         <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
    </div>
</div>
@enderror

<div class="col-md-12">
    <div>
        <div class="form-group">
            <label>
                <input name="status"
                       {{ isset($offer) && $offer->status ? 'checked':old('status')}} type="checkbox"
                       class="i-checks">
                Publication Status
            </label>
        </div>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(".date").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i:00",
        });
    </script>
@endpush
