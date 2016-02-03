@if($contents->count() > 1)
    @include('mc388-simple-cms::site.contents.root.multiple', ['contents' => $contents])
@else
    @include('mc388-simple-cms::site.contents.root.single', ['content' => $contents->first()])
@endif

