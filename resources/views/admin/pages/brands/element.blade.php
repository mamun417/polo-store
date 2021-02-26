@push('style')
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush

<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="control-label">Brand Name<span class="required-star"> *</span></label>
        <input id="name" type="text" value="{{ isset($brand) ? @$brand->name : old('name')}}"
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
        <label for="web_url" class="control-label">Brand Url</label>
        <input id="web_url" type="text" value="{{ isset($brand) ? @$brand->web_url : old('web_url')}}"
               name="web_url" class="form-control" autofocus>

        @error('web_url')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="description" class="control-label">Description</label>
        <textarea class="form-control brandTextEditor" name="description" id="description">
            {{ isset($brand) && @$brand->description ? @$brand->description : old('description')}}
        </textarea>

        @error('description')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-md-12">
    <div>
        <div class="form-group">
            <label>
                <input name="status"
                       {{ isset($brand) && @$brand->status ? 'checked':old('status')}}
                       type="checkbox"
                       class="i-checks">
                       Publication Status
            </label>
        </div>
    </div>
</div>

@push('script')
    <script src="{{ asset('backend/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.brandTextEditor').summernote();
        });
    </script>
@endpush
