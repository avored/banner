<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored-banner::banner.name') }}"
        field-name="name"
        init-value="{{ $banner->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-upload
        label-text="{{ __('avored-banner::banner.image') }}"
        field-name="image_path"
        init-value="{{ $banner->image_path ?? '' }}" 
        error-text="{{ $errors->first('image_path') }}"
        upload-url="{{ route('admin.banner.upload') }}"
    ></avored-upload>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored-banner::banner.alt_text') }}"
        field-name="alt_text"
        init-value="{{ $banner->alt_text ?? '' }}" 
        error-text="{{ $errors->first('alt_text') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored-banner::banner.url') }}"
        field-name="url"
        init-value="{{ $banner->url ?? '' }}" 
        error-text="{{ $errors->first('url') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored-banner::banner.target') }}"
        field-name="target"
        :options="{{ json_encode($targetOptions) }}"
        init-value="{{ $banner->target ?? '' }}" 
        error-text="{{ $errors->first('target') }}"
    ></avored-select>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored-banner::banner.status') }}"
        error-text="{{ $errors->first('status') }}"
        field-name="status"
        toggle-on-value="ENABLED"
        toggle-off-value="DISABLED"
        init-value="{{ $banner->status ?? '' }}"
    >
    </avored-toggle>
</div>


<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored-banner::banner.sort_order') }}"
        field-name="sort_order"
        init-value="{{ $banner->sort_order ?? '' }}" 
        error-text="{{ $errors->first('sort_order') }}"
    >
    </avored-input>
</div>
