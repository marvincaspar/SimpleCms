<ul class="dropdown-menu">
    @foreach ($children as $node)
        <li class="{{ $node->hasChildren()? 'dropdown-submenu' : '' }}">
            <a href="{{ $node->getUrl()  }}">
                {{ $node->nav_title  }}
            </a>
            @if($node->hasChildren())
                @include('mc388-simple-cms::site.partials.subnavigation', ['children' => $node->getChildren()])
            @endif
        </li>
    @endforeach
</ul>
