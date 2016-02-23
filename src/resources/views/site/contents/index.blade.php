@if($contents->count() > 1)
    @include('simple-cms::site.contents.root.multiple', ['contents' => $contents])
@else
    @include('simple-cms::site.contents.root.single', ['content' => $contents->first()])
@endif

