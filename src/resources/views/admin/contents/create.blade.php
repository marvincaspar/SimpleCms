@extends('simple-cms::layouts.admin')

@section('content-header')
    @include('simple-cms::admin.contents.partials.header')
@endsection

@section('content-body')
    <div class="row">
        <div class="col-md-12">
            <form action="{!! URL::route('manage.contents.store', array('content' => $content->slug)) !!}"
                  id="site-form" class="form-horizontal" method="POST">
                {!! csrf_field() !!}

                <input type="hidden" name="parent_id" id="parent_id" value="{{ $content->parent_id }}">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ trans('simple-cms::sites.box_title_new') }}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('simple-cms::admin.contents.partials.form')
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">
                                    {{ trans('simple-cms::generic.save') }}
                                </button>
                                <a class="btn btn-default" href="{{ URL::route('manage.contents.index') }}">
                                    {{ trans('simple-cms::generic.cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('admin-scripts')
    @include('simple-cms::admin.contents.partials.js')
@stop
