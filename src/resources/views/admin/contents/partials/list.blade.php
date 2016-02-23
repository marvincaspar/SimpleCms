@foreach ($contents as $content)
    <li data-id="{{ $content->id }}" data-parent_id="{{ $content->parent_id }}" data-lft="{{ $content->lft }}"
        data-rgt="{{ $content->rgt }}" data-name="{{ $content->nav_title }}">
        <i class="glyphicon glyphicon-list drag-handler"></i>

        @if($content->isRoot())
            <i class="glyphicon glyphicon-home content-type"></i>
        @endif

        @if($content->type == \Mc388\SimpleCms\App\Models\Content::TYPE_GLOBAL)
            <i class="glyphicon glyphicon-globe content-type"></i>
        @endif

        @if($content->type == \Mc388\SimpleCms\App\Models\Content::TYPE_LINK)
            <i class="glyphicon glyphicon-link content-type"></i>
        @endif

        <span>{{ $content->nav_title }}</span>
        <i class="glyphicon glyphicon-trash action action-delete"></i>
        <a href="{{ $content->getEditUrl() }}">
            <i class="glyphicon glyphicon-pencil action action-edit"></i>
        </a>
        <ol>
            @if($content->hasChildren())
                @include('simple-cms::admin.contents.partials.list', ['contents' => $content->getChildren()])
            @endif
        </ol>
    </li>
@endforeach
