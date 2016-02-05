<div class="modal fade" tabindex="-1" role="dialog" id="upload-file">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('manage.media.file.create') }}"
                  class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ trans('simple-cms::media.upload_file') }}</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <input type="hidden" name="folder" value="{{ $folder }}">

                    <div class="form-group">
                        <label for="file" class="col-sm-2 control-label">{{ trans('simple-cms::media.file') }}</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file" id="file"
                                   placeholder="Media file">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file_name"
                               class="col-sm-2 control-label">{{ trans('simple-cms::media.filename_optional') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="file_name" id="file_name"
                                   placeholder="Optional filename">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('simple-cms::generic.close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-upload"></i> {{ trans('simple-cms::media.upload') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-file">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('manage.media.file.delete') }}"
                  class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ trans('simple-cms::media.delete_file') }}</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="folder" value="{{ $folder }}">
                    <input type="hidden" name="del_file" id="delete-file-name2">

                    {{ trans('simple-cms::media.delete_file_question') }}
                    <strong><span id="delete-file-name1">file</span></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('simple-cms::generic.close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-trash"></i> {{ trans('simple-cms::media.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="link-file">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ trans('simple-cms::media.lint_to_file') }}</h4>
            </div>
            <div class="modal-body">
                <span id="link-file-name"></span>

                <div class="form-group">
                    <label for="link-file-path"
                           class="col-sm-2 control-label">{{ trans('simple-cms::media.file') }}</label>
                    <input type="text" id="link-file-path" name="link-file-path" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ trans('simple-cms::generic.close') }}</button>
            </div>
        </div>
    </div>
</div>


{{--<div class="md-modal md-effect-8 mdl-color--blue-grey-800" id="create-folder">--}}
{{--<div class="md-content">--}}
{{--<div class="mdl-color--blue-grey-900 header">--}}
{{--<h3>Upload File</h3>--}}
{{--<button class="md-close mdl-button mdl-js-button mdl-button--icon">--}}
{{--<i class="material-icons">clear</i>--}}
{{--</button>--}}
{{--</div>--}}

{{--<div>--}}
{{--<form method="POST" action="/admin/upload/folder"--}}
{{--class="form-horizontal">--}}
{{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--<input type="hidden" name="folder" value="{{ $folder }}">--}}


{{--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">--}}
{{--<input name="new_folder" class="mdl-textfield__input">--}}
{{--<label class="mdl-textfield__label">Folder Name</label>--}}
{{--</div>--}}
{{--<div class="button-action">--}}
{{--<button type="submit"--}}
{{--class="md-close mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">--}}
{{--Upload--}}
{{--</button>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
