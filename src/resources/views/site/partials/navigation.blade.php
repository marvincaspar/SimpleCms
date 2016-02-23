<?php $hierarchy = $content->getRoot()->getDescendants()->toHierarchy(); ?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="{{ $isMobile ? 'float: none' : '' }}">
            <a class="navbar-brand" href="{{ URL::route('root') }}">
                <img src="{{ asset('images/logo.png') }}" id="logo"/>
            </a>
            @if ($isMobile)
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-mobile">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            @endif
        </div>

        @if ($isMobile == false)
            <ul class="nav navbar-nav" id="nav-desktop">
                @foreach ($hierarchy as $node)
                    @if($node['type'] != \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL)
                        <li class="{{ $content->isActive($node) ?  'active' : '' }} {{ $node->hasChildren()? 'dropdown-submenu' : '' }}">
                            <a href="{{ $node->getUrl() }}">{{ $node->nav_title  }}</a>
                            @if($node->hasChildren())
                                @include('simple-cms::site.partials.subnavigation', ['children' => $node->getChildren()])
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</nav>
@if ($isMobile)
    <div class="mobile-nav-wrapper navbar-default">
        <div class="collapse" id="nav-mobile">
            <ul class="nav navbar-nav">
                @foreach ($hierarchy as $node)
                    @if($node['type'] != \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL)
                        <li>
                            <a href="{{ $node->getUrl() }}" style="padding-left: 25px">
                                {{ $node->nav_title  }}
                            </a>
                        </li>
                        @if($node->hasChildren())
                            @include('simple-cms::site.partials.mobilesubnavigation', ['children' => $node->getChildren()])
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
@endif
