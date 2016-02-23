@extends('simple-cms::layouts.admin')

@section('content-header')
    @include('simple-cms::admin.contents.partials.header')
@endsection

@section('content-body')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('simple-cms::sites.box_title') }}</h3>
                </div>
                <div class="box-controls with-border">
                    <div class="btn-group">
                        <a class="btn btn-default btn-sm" href="{!! route('manage.contents.create') !!}">
                            <i class="glyphicon glyphicon-file"></i> {{ trans('simple-cms::sites.new') }}
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="manage-contents">
                                @include('simple-cms::admin.contents.partials.list', ['contents' => $contents])
                                <input type="hidden" id="updateUrl"
                                       value="{{ route('manage.contents.updateHierarchy') }}">
                                <input type="hidden" id="indexUrl" value="{{ route('manage.contents.index') }}">
                                {!! csrf_field() !!}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('admin-scripts')
    <script src="{{ asset('simple-cms/js/admin/jquery-sortable.js') }}"></script>
    <script>

        $(function () {
            var tree = $("ol.manage-contents").sortable({
                handle: 'i.drag-handler',
                group: 'manage-contents',
                onDrop: function ($item, container, _super) {
                    var data = tree.sortable("serialize").get();
                    var newData = orderArray(data[0], 0, null, 0);
                    var jsonString = JSON.stringify(newData, null, ' ');
                    var updateUrl = $('#updateUrl').val();

                    _super($item, container);

                    setAjaxHeader();
                    $.ajax({
                        type: "POST",
                        url: updateUrl,
                        data: {
                            list: jsonString
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                }
            });

            $('.action-delete').click(function (e) {
                e.preventDefault();

                var target = e.target;
                var parent = $(target).parent('li');
                var id = $(parent).data('id');
                var name = $(parent).data('name');
                var indexUrl = $('#indexUrl').val();

                if (confirm("Are you really want to delete content '" + name + "'?")) {
                    setAjaxHeader();
                    $.ajax({
                        type: "DELETE",
                        url: indexUrl + "/" + id,
                        success: function (data) {
                            console.log(data);
                            $(parent).remove();
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                }
            });
        });

        function orderArray(data, counter, parent_id, depth) {
            var flatList = [];

            data.forEach(function (element, index, array) {
                counter++;

                element.lft = counter;
                element.parent_id = parent_id;

                if (element.children != undefined && element.children.length > 0) {
                    if (element.children[0].length > 0) {
                        element.children = orderArray(element.children[0], counter, element.id, depth + 1);
                        counter = element.children[element.children.length - 1].rgt;

                        flatList = flatList.concat(element.children);
                    }

                    delete element['children'];
                }

                counter++;
                element.rgt = counter;
                element.depth = depth;

                flatList.push(element);
            });

            return flatList;
        }
    </script>
@stop
