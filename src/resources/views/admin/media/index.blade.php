@extends('simple-cms::layouts.admin')

@section('content-header')
    <h1>
        {{ trans('simple-cms::media.title') }}
        <small>{{ trans('simple-cms::media.title_small') }}</small>
    </h1>
@endsection

@section('content-body')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('simple-cms::media.box_title') }}</h3>
                </div>
                <div class="box-controls with-border">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#upload-file">
                            <i class="glyphicon glyphicon-upload"></i> {{ trans('simple-cms::media.upload') }}
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="media-files clearfix">
                        @foreach ($files as $file)
                            @if (starts_with($file['name'], '.') == false)
                                <li>
                                    <span class="media-file-icon has-img">
                                        @if (starts_with($file['mimeType'], 'image'))
                                            <img src="{{ $file['webPath'] }}" alt="Attachment">
                                        @else
                                            <i class="glyphicon glyphicon-file"></i>
                                        @endif
                                    </span>

                                    <div class="media-file-info">
                                        <a href="#" class="media-file-name">
                                            {{ $file['name'] }}
                                        </a>
                                        <span class="media-file-size">
                                          {{ $file['size'] }}
                                            <button type="button"
                                                    class="btn btn-default btn-xs pull-right"
                                                    onclick="link_file('{{ $file['name'] }}', '{{ $file['webPath'] }}')"
                                                    data-toggle="modal"
                                                    data-target="#link-file">
                                                <i class="glyphicon glyphicon-link"></i>
                                            </button>

                                            <button type="button"
                                                    class="btn btn-default btn-xs pull-right"
                                                    onclick="delete_file('{{ $file['name'] }}')"
                                                    data-toggle="modal"
                                                    data-target="#delete-file">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content-footer')
    @include('simple-cms::admin.partials.modal')
@stop

@section('admin-scripts')
    <script>
        // Confirm file delete
        function delete_file(name) {
            $("#delete-file-name1").html(name);
            $("#delete-file-name2").val(name);
        }

        // Confirm file delete
        function link_file(name, path) {
            $("#link-file-name").html(name);
            $("#link-file-path").val(path);
        }

        // Confirm folder delete
        function delete_folder(name) {
            $("#delete-folder-name1").html(name);
            $("#delete-folder-name2").val(name);
        }

        // Preview image
        function preview_image(path) {
            $("#preview-image").attr("src", path);
        }
    </script>
@stop
