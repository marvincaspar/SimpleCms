@foreach ($children as $node)
    <li>
        <a href="{{ $node->getUrl() }}" style="padding-left: {{ 25 + $node->depth * 10 }}px">
            {{ $node->nav_title }}
        </a>
    </li>
    @if($node->hasChildren())
        @include('simple-cms::site.partials.mobilesubnavigation', ['children' => $node->getChildren()])
    @endif
@endforeach
