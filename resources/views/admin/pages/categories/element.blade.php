<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="control-label">Category Name<span
                class="required-star"> *</span>
        </label>

        <input id="name" type="text"
               value="{{ isset($category) ? @$category->name : old('name')}}"
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
        <label for="parent_id" class="control-label">Parent Category</label>

        <select id="parent_id" class="form-control m-b" name="parent_id">
            <option value="0">None</option>
            @foreach(@$main_categories as $main_category)
                @include('admin.components.tree-categories', ['main_categories' => @$main_category])
            @endforeach
        </select>

        @error('parent_id')
        <span class="help-block m-b-none text-danger">
            {{ @$message }}
        </span>
        @enderror

    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="description" class="control-label">{{ __('Description') }}</label>
        <textarea
            type="text" id="description"
            class="form-control @error('description') is-invalid @enderror"
            name="description"
            rows="4"
        >{{ isset($category) ? @$category->description : old('description') }}</textarea>

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
                       {{ isset($category) && @$category->status ? 'checked':old('status')}} type="checkbox"
                       class="i-checks">
                Publication Status
            </label>
        </div>
    </div>
</div>
