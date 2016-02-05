@extends('simple-cms::layouts.admin')

@section('content-header')
    <h1>
        {{ trans('simple-cms::dashboard.title') }}
        <small>{{ trans('simple-cms::dashboard.title_small') }}</small>
    </h1>
@stop

@section('content-body')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $contentsCount }}</h3>

                    <p>{{ trans('simple-cms::sites.title') }}</p>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-duplicate"></i>
                </div>
                <a href="{{ route('manage.contents.index') }}" class="small-box-footer">
                    {{ trans('simple-cms::dashboard.more_info') }} <i class="glyphicon glyphicon-circle-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $mediaCount }}</h3>

                    <p>{{ trans('simple-cms::media.title') }}</p>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-picture"></i>
                </div>
                <a href="{{ route('manage.media.index') }}" class="small-box-footer">
                    {{ trans('simple-cms::dashboard.more_info') }} <i class="glyphicon glyphicon-circle-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
