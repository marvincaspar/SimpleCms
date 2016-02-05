<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-sm-2 control-label">{{ trans('simple-cms::sites.attributes.title') }}</label>

    <div class="col-sm-10">
        <input type="text" class="form-control" name="title" id="title"
               placeholder="{{ trans('simple-cms::sites.attributes.title') }}"
               value="{{ old('title', $content->title) }}">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('nav_title') ? 'has-error' : '' }}">
    <label for="nav_title" class="col-sm-2 control-label">{{ trans('simple-cms::sites.attributes.nav_title') }}</label>

    <div class="col-sm-10">
        <input type="text" class="form-control" name="nav_title" id="nav_title"
               placeholder="{{ trans('simple-cms::sites.attributes.nav_title') }}"
               value="{{ old('nav_title', $content->nav_title) }}">

        @if ($errors->has('nav_title'))
            <span class="help-block">
                <strong>{{ $errors->first('nav_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    <label class="col-sm-2 control-label">{{ trans('simple-cms::sites.attributes.type') }}</label>

    <div class="col-sm-10">
        <div class="radio">
            <label>
                <input type="radio" name="type" id="type-{{ \Mc388\SimpleCms\App\Models\Content::TYPE_SITE }}"
                       value="{{ \Mc388\SimpleCms\App\Models\Content::TYPE_SITE }}" {{ $content->type == \Mc388\SimpleCms\App\Models\Content::TYPE_SITE ? 'checked' : '' }}>
                {{ trans('simple-cms::sites.attributes.type_site') }}
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="type" id="type-{{ \Mc388\SimpleCms\App\Models\Content::TYPE_LINK }}"
                       value="{{ \Mc388\SimpleCms\App\Models\Content::TYPE_LINK }}" {{ $content->type == \Mc388\SimpleCms\App\Models\Content::TYPE_LINK ? 'checked' : '' }}>
                {{ trans('simple-cms::sites.attributes.type_link') }}
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="type" id="type-{{ \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL }}"
                       value="{{ \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL }}" {{ $content->type == \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL ? 'checked' : '' }}>
                {{ trans('simple-cms::sites.attributes.type_global') }}
            </label>
        </div>

        @if ($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>


<div id="content-wrapper">
    <div class="form-group">
        <label for="banner" class="col-sm-2 control-label">{{ trans('simple-cms::sites.attributes.banner') }}</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" name="banner" id="banner"
                   placeholder="{{ trans('simple-cms::sites.attributes.banner_url') }}"
                   value="{{ old('banner', $content->banner) }}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <textarea name="body" id="content-textarea"
                  placeholder="{{ trans('simple-cms::sites.attributes.body_placeholder') }}">
            {{ old('body', $content->body) }}
        </textarea>
        </div>
    </div>
</div>

<div id="link-wrapper">
    <div class="form-group">
        <label for="link_to_content_id"
               class="col-sm-2 control-label">{{ trans('simple-cms::sites.attributes.select_link') }}</label>

        <div class="col-sm-10">
            <select name="link_to_content_id" id="select-link-to-content"
                    placeholder="{{ trans('simple-cms::sites.attributes.select_link') }}">
                <option value="">{{ trans('simple-cms::sites.attributes.select_link') }}</option>
                @foreach ($contents as $id => $title)
                    @if($id != $content->id)
                        @if($id == $content->link_to_content_id)
                            <option value="{{ $id }}" selected>{{ $title }}</option>
                        @else
                            <option value="{{ $id }}">{{ $title }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
    </div>

</div>
